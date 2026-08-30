<?php

namespace OffTheGridCG;

class Functions
{
    public static function renderSitemap(): string
    {
        $config = CONFIG::getInstance();
        $baseUrl = rtrim($config->get('APP_URL'), '/');

        $urls = [];
        foreach (glob($config->get('PAGES_PATH') . '*.php') as $file) {
            $slug = basename($file, '.php');
            $path = $slug === 'home' ? '/' : '/' . $slug;
            $urls[$path] = date('Y-m-d', filemtime($file));
        }
        ksort($urls);

        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        foreach ($urls as $path => $lastmod) {
            $loc = htmlspecialchars($baseUrl . $path, ENT_XML1 | ENT_QUOTES);
            $xml .= "    <url>\n        <loc>{$loc}</loc>\n        <lastmod>{$lastmod}</lastmod>\n    </url>\n";
        }
        $xml .= "</urlset>\n";

        return $xml;
    }

    public static function renderRobotsTxt(): string
    {
        $baseUrl = rtrim(CONFIG::getInstance()->get('APP_URL'), '/');

        return "User-agent: *\nAllow: /\n\nSitemap: {$baseUrl}/sitemap.xml\n";
    }

    public static function renderLlmsTxt(): string
    {
        $baseUrl = rtrim(CONFIG::getInstance()->get('APP_URL'), '/');

        $pages = [
            '' => ['Home', 'Official homepage of OffTheGridCG'],
            'about' => ['About', 'About Oscar Freij and his interests'],
            'projects' => ['Projects', 'A selection list of projects worked on, in progress, or planned, with links for more info'],
            'contact' => ['Contact', 'How to get in contact with Oscar Freij in various ways'],
        ];

        $txt = "# OffTheGridCG\n\n";
        $txt .= "> Personal website of Oscar Freij - software developer, IT/infrastructure specialist, and hobbyist maker.\n\n";
        $txt .= "## Pages\n\n";
        foreach ($pages as $slug => [$title, $description]) {
            $txt .= "- [{$title}]({$baseUrl}/{$slug}): {$description}\n";
        }

        return $txt;
    }

    public static function renderProjectsList(): string
    {
        $rows = DB::getInstance()->query("SELECT id FROM `projects` ORDER BY id ASC", []);

        if ($rows === null) {
            return '<p class="text-center">Projects could not be loaded right now. Please try again later.</p>';
        }

        if (empty($rows)) {
            return '<p class="text-center">No projects to show yet.</p>';
        }

        $html = '';
        foreach ($rows as $row) {
            $html .= self::renderProjectCard(new project((int) $row['id']));
        }

        return $html;
    }

    private static function renderProjectCard(project $project): string
    {
        // All project data is entered by the site owner, not end users, so "description" is
        // treated as trusted, developer-authored markup (it may contain inline tags like
        // <a>/<b>) and intentionally NOT escaped here. Revisit if this ever accepts user input.
        $status = htmlspecialchars($project->status->value, ENT_QUOTES);
        $statusLabel = htmlspecialchars(self::statusLabel($project->status), ENT_QUOTES);
        $title = htmlspecialchars($project->title, ENT_QUOTES);

        $links = '';
        foreach ($project->links ?? [] as $link) {
            $label = htmlspecialchars($link['label'] ?? 'LINK', ENT_QUOTES);
            $url = htmlspecialchars($link['url'] ?? '#', ENT_QUOTES);
            $links .= "        <a href=\"{$url}\">&rarr; {$label}</a>\n";
        }

        $html = "<div status=\"{$status}\">\n";
        $html .= "    <p class=\"project-status\">[{$statusLabel}]</p>\n";
        $html .= "    <h3>{$title}</h3>\n";
        if ($links !== '') {
            $html .= "    <div class=\"project-links\">\n{$links}    </div>\n";
        }

        foreach (array_filter(explode("\n\n", (string) $project->description)) as $paragraph) {
            $html .= "    <p>{$paragraph}</p>\n";
        }

        if ($project->notes) {
            $html .= "    <p><b>NOTE:</b> {$project->notes}</p>\n";
        }

        if ($project->status === projectStatus::Dropped && $project->dropReason) {
            $dropReason = htmlspecialchars($project->dropReason, ENT_QUOTES);
            $html .= "    <p><b>DROP REASON:</b> {$dropReason}</p>\n";
        }

        $html .= "</div>\n";

        return $html;
    }

    private static function statusLabel(projectStatus $status): string
    {
        return match ($status) {
            projectStatus::Done => 'DONE',
            projectStatus::OnHold => 'ON HOLD',
            projectStatus::Active => 'ACTIVE',
            projectStatus::Planning => 'PLANNING',
            projectStatus::Dropped => 'DROPPED',
        };
    }
}

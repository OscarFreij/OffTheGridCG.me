<footer id="footer" class="footer">
    <ul class="footer-social">
        <li>
            <a href="https://github.com/OscarFreij" aria-label="GitHub" target="_blank" rel="noopener noreferrer">
                <?php readfile($CONFIG->get('ICONS_PATH').'github.svg'); ?>
            </a>
        </li>
        <li>
            <a href="https://www.linkedin.com/in/oscar-freij-4a5690165/" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
                <?php readfile($CONFIG->get('ICONS_PATH').'linkedin.svg'); ?>
            </a>
        </li>
        <li>
            <a href="https://instagram.com/ogglas_unlimited" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                <?php readfile($CONFIG->get('ICONS_PATH').'instagram.svg'); ?>
            </a>
        </li>
    </ul>
    &copy; <?= date("Y") ?> Oscar Freij. All rights reserved.
</footer>
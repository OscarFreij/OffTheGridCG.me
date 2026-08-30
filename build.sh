#!/usr/bin/env bash
# Bundles static CSS into one file and writes a cache-busting version.
#
# Usage:
#   ./build.sh          Version = current git commit hash (prod)
#   ./build.sh --dev    Version = random, changes every run (dev)
set -euo pipefail

cd "$(dirname "$0")"

CSS_DIR="public_html/static/css"
OUTPUT="$CSS_DIR/bundle.css"
VERSION_FILE="private_html/data/version.ini"

if [ "${1:-}" = "--dev" ]; then
    VERSION="dev-$(date +%s)-$RANDOM"
else
    VERSION="$(git rev-parse --short HEAD 2>/dev/null || echo "unknown")"
fi

cat \
    "$CSS_DIR/google_fonts.css" \
    "$CSS_DIR/navbar.css" \
    "$CSS_DIR/master.css" \
    "$CSS_DIR/home.css" \
    "$CSS_DIR/projects.css" \
    "$CSS_DIR/contact.css" \
    > "$OUTPUT"

printf 'version = %s\n' "$VERSION" > "$VERSION_FILE"

echo "Built $OUTPUT ($(wc -c < "$OUTPUT") bytes), version=$VERSION"

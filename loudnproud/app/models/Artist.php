<?php
require_once __DIR__ . '/../../config/database.php';

class Artist {

    public static function all(): array {
        $db = Database::connect();
        return $db->query("SELECT * FROM artists ORDER BY popularity DESC")->fetchAll();
    }

    public static function getMainLineup(): array {
        $db = Database::connect();
        return $db->query("SELECT * FROM artists WHERE is_headliner = 1 ORDER BY popularity DESC")->fetchAll();
    }

    public static function days(): array {
        $db = Database::connect();
        return $db->query("SELECT DISTINCT performance_day FROM artists ORDER BY performance_day")
                  ->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Per-artist Wikipedia lookup config.
     * Each entry is an array of [lang, title] pairs tried in order.
     * Empty array = no photo available (masked artist etc), use local SVG instead.
     */
    private static function wikiLookups(): array {
        return [
            // Wears a balaclava — no face photo exists. We serve a local illustrated SVG.
            'EsDeeKid'           => [],

            // CZ artists — Czech Wikipedia
            'Nik Tendo'          => [['cs', 'Nik Tendo']],
            'Ektor'              => [['cs', 'Ektor']],
            'Calin'              => [['cs', 'Calin'], ['cs', 'Calin (rapper)']],   // CZ, not SK

            // SK artists — Slovak Wikipedia
            'Separ'              => [['sk', 'Separ']],
            'Pil C'              => [['sk', 'Pil C'], ['cs', 'Pil C']],            // SK, not CZ
            'Vec'                => [['sk', 'Vec (rapper)'], ['sk', 'Vec']],
            'Majk Spirit'        => [['sk', 'Majk Spirit'], ['cs', 'Majk Spirit']],
            'Kontrafakt'         => [['sk', 'Kontrafakt'], ['cs', 'Kontrafakt']],

            // US / UK — English Wikipedia with disambiguated titles where needed
            'Dave'               => [['en', 'Dave (rapper)']],
            'Stormzy'            => [['en', 'Stormzy']],
            'Central Cee'        => [['en', 'Central Cee']],
            'Little Simz'        => [['en', 'Little Simz']],
            'Skepta'             => [['en', 'Skepta']],
            'Kendrick Lamar'     => [['en', 'Kendrick Lamar']],
            'Tyler, the Creator' => [['en', 'Tyler, the Creator']],
            'J. Cole'            => [['en', 'J. Cole']],
            'Travis Scott'       => [['en', 'Travis Scott (rapper)'], ['en', 'Travis Scott']],
            '21 Savage'          => [['en', '21 Savage']],
            'Denzel Curry'       => [['en', 'Denzel Curry']],
        ];
    }

    /**
     * Fetch one Wikipedia thumbnail. Returns URL string or ''.
     */
    private static function fetchWikiThumb(string $lang, string $title): string {
        $t   = urlencode(str_replace(' ', '_', $title));
        $url = "https://{$lang}.wikipedia.org/w/api.php?action=query&titles={$t}&prop=pageimages&format=json&pithumbsize=500&piprop=thumbnail";
        $ctx = stream_context_create(['http' => [
            'timeout' => 5,
            'header'  => "User-Agent: LoudnProudFestival/1.0 (school project)\r\n",
        ]]);
        $json = @file_get_contents($url, false, $ctx);
        if (!$json) return '';
        $data  = json_decode($json, true);
        $pages = $data['query']['pages'] ?? [];
        $page  = reset($pages);
        if (empty($page) || isset($page['missing'])) return '';
        return $page['thumbnail']['source'] ?? '';
    }

    /**
     * Returns image src for an artist.
     * For EsDeeKid: returns path to local balaclava SVG.
     * For others: tries Wikipedia API across configured lang/title pairs.
     * Falls back to en.wikipedia with raw name if not in lookup table.
     */
    public static function getWikipediaImage(string $artistName): string {
        $lookups = self::wikiLookups();

        // Masked artist — serve local illustrated SVG
        if (isset($lookups[$artistName]) && count($lookups[$artistName]) === 0) {
            return 'public/images/esdeekid.jpg';
        }

        // Try configured pairs
        if (!empty($lookups[$artistName])) {
            foreach ($lookups[$artistName] as [$lang, $title]) {
                $img = self::fetchWikiThumb($lang, $title);
                if ($img) return $img;
            }
            return '';
        }

        // Generic fallback
        return self::fetchWikiThumb('en', $artistName);
    }
}

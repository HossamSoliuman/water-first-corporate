<?php

namespace Database\Seeders\Concerns;

/**
 * Inline-styled HTML building blocks for CMS-managed rich content.
 *
 * Public pages drop CMS HTML into a `.prose` wrapper, but the frontend loads the
 * Tailwind CDN *without* the typography plugin, so preflight strips heading sizes
 * and list markers and `.prose` only sets a handful of colours. Every block below
 * therefore carries its own inline CSS, which keeps seeded content looking right
 * on the public site and inside the admin raw-HTML textarea alike.
 *
 * Layouts use `grid-template-columns: repeat(auto-fit, minmax(...))` and flex
 * wrapping instead of media queries, because inline styles cannot carry
 * breakpoints. Every string argument is treated as trusted HTML, not escaped.
 */
trait BuildsRichContent
{
    private const HEADING_FONT = "'Sora',ui-sans-serif,system-ui,sans-serif";

    private const MONO_FONT = "'IBM Plex Mono',ui-monospace,SFMono-Regular,monospace";

    private const INK = '#12324A';

    private const INK_BODY = '#2D5367';

    private const INK_MUTED = '#4B829D';

    private const LINE = '#C9DEE9';

    private const LINE_SOFT = '#E5F0F6';

    private const PRIMARY = '#07579A';

    private const ACCENT = '#00A6A6';

    private const SURFACE = '#F5FBFE';

    private const ACCENT_SOFT = '#ECFEFE';

    /**
     * Opening statement, set larger than body copy behind an accent rule.
     */
    protected function richLead(string $html): string
    {
        return '<p style="margin:0 0 2rem;padding:.15rem 0 .15rem 1.15rem;border-left:3px solid '.self::ACCENT.';font-size:1.125rem;line-height:1.85;color:'.self::INK_BODY.';">'.$html.'</p>';
    }

    /**
     * Section header: mono eyebrow, display title and a short accent rule.
     */
    protected function richHeading(string $eyebrow, string $title, int $level = 2): string
    {
        $size = $level === 2 ? '1.5rem' : '1.2rem';
        $tag = 'h'.$level;

        return '<div style="margin:2.75rem 0 1.35rem;">'
            .'<span style="display:block;font-family:'.self::MONO_FONT.';font-size:.625rem;font-weight:600;letter-spacing:.16em;text-transform:uppercase;color:'.self::ACCENT.';">'.$eyebrow.'</span>'
            .'<'.$tag.' style="margin:.55rem 0 0;font-family:'.self::HEADING_FONT.';font-size:'.$size.';font-weight:600;letter-spacing:-.035em;line-height:1.25;color:'.self::INK.';">'.$title.'</'.$tag.'>'
            .'<span style="display:block;width:2.75rem;height:2px;margin-top:.85rem;background:'.self::ACCENT.';"></span>'
            .'</div>';
    }

    protected function richParagraph(string $html): string
    {
        return '<p style="margin:0 0 1.25rem;font-size:1rem;line-height:1.8;color:'.self::INK_BODY.';">'.$html.'</p>';
    }

    /**
     * Hairline-divided metric tiles.
     *
     * @param  array<int, array{value: string, label: string}>  $stats
     */
    protected function richStats(array $stats): string
    {
        $tiles = '';

        foreach ($stats as $stat) {
            $tiles .= '<div style="background:#FFFFFF;padding:1.1rem 1.15rem;">'
                .'<span style="display:block;font-family:'.self::MONO_FONT.';font-size:1.45rem;font-weight:600;letter-spacing:-.04em;line-height:1.1;color:'.self::PRIMARY.';">'.$stat['value'].'</span>'
                .'<span style="display:block;margin-top:.45rem;font-family:'.self::MONO_FONT.';font-size:.625rem;letter-spacing:.13em;text-transform:uppercase;line-height:1.5;color:'.self::INK_MUTED.';">'.$stat['label'].'</span>'
                .'</div>';
        }

        return '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:1px;margin:0 0 2rem;background:'.self::LINE.';border:1px solid '.self::LINE.';border-radius:.5rem;overflow:hidden;">'.$tiles.'</div>';
    }

    /**
     * Two-column checklist with square accent markers.
     *
     * @param  array<int, string>  $items
     */
    protected function richChecklist(array $items): string
    {
        $rows = '';

        foreach ($items as $item) {
            $rows .= '<li style="display:flex;align-items:flex-start;gap:.7rem;padding:.65rem 0;border-top:1px solid '.self::LINE_SOFT.';">'
                .'<span style="flex:none;width:6px;height:6px;margin-top:.6rem;background:'.self::ACCENT.';"></span>'
                .'<span style="font-size:.9375rem;line-height:1.65;color:'.self::INK_BODY.';">'.$item.'</span>'
                .'</li>';
        }

        return '<ul style="list-style:none;margin:0 0 2rem;padding:0;display:grid;grid-template-columns:repeat(auto-fit,minmax(270px,1fr));gap:0 1.75rem;">'.$rows.'</ul>';
    }

    /**
     * Numbered capability cards.
     *
     * @param  array<int, array{title: string, body: string}>  $cards
     */
    protected function richCards(array $cards): string
    {
        $items = '';

        foreach ($cards as $index => $card) {
            $items .= '<div style="border:1px solid '.self::LINE.';border-radius:.5rem;background:#FFFFFF;padding:1.25rem;box-shadow:0 18px 50px -30px rgba(18,50,74,.35);">'
                .'<span style="font-family:'.self::MONO_FONT.';font-size:.75rem;font-weight:600;letter-spacing:.12em;color:'.self::ACCENT.';">'.str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT).'</span>'
                .'<h4 style="margin:.7rem 0 .5rem;font-family:'.self::HEADING_FONT.';font-size:1rem;font-weight:600;letter-spacing:-.02em;line-height:1.35;color:'.self::INK.';">'.$card['title'].'</h4>'
                .'<p style="margin:0;font-size:.875rem;line-height:1.7;color:'.self::INK_MUTED.';">'.$card['body'].'</p>'
                .'</div>';
        }

        return '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:1rem;margin:0 0 2rem;">'.$items.'</div>';
    }

    /**
     * Data table in a horizontally scrollable frame.
     *
     * @param  array<int, string>  $headers
     * @param  array<int, array<int, string>>  $rows
     */
    protected function richTable(array $headers, array $rows): string
    {
        $head = '';

        foreach ($headers as $header) {
            $head .= '<th style="padding:.75rem .9rem;text-align:left;font-family:'.self::MONO_FONT.';font-size:.625rem;font-weight:600;letter-spacing:.13em;text-transform:uppercase;color:'.self::PRIMARY.';border-bottom:1px solid '.self::LINE.';white-space:nowrap;">'.$header.'</th>';
        }

        $body = '';

        foreach ($rows as $row) {
            $cells = '';

            foreach ($row as $column => $cell) {
                $emphasis = $column === 0
                    ? 'font-family:'.self::MONO_FONT.';font-weight:600;color:'.self::PRIMARY.';white-space:nowrap;'
                    : 'color:'.self::INK_BODY.';';
                $cells .= '<td style="padding:.8rem .9rem;font-size:.875rem;line-height:1.6;border-top:1px solid '.self::LINE_SOFT.';vertical-align:top;'.$emphasis.'">'.$cell.'</td>';
            }

            $body .= '<tr>'.$cells.'</tr>';
        }

        return '<div style="overflow-x:auto;margin:0 0 2rem;border:1px solid '.self::LINE.';border-radius:.5rem;background:#FFFFFF;">'
            .'<table style="width:100%;min-width:34rem;border-collapse:collapse;">'
            .'<thead style="background:'.self::SURFACE.';"><tr>'.$head.'</tr></thead>'
            .'<tbody>'.$body.'</tbody>'
            .'</table></div>';
    }

    /**
     * Vertical numbered process flow.
     *
     * @param  array<int, array{title: string, body: string}>  $steps
     */
    protected function richSteps(array $steps): string
    {
        $items = '';
        $last = count($steps) - 1;

        foreach ($steps as $index => $step) {
            $connector = $index === $last ? 'transparent' : self::LINE;
            $items .= '<li style="position:relative;margin:0 0 0 1.1rem;padding:0 0 1.5rem 2.25rem;border-left:1px solid '.$connector.';">'
                .'<span style="position:absolute;left:-1.1rem;top:-.15rem;display:flex;align-items:center;justify-content:center;width:2.2rem;height:2.2rem;border-radius:999px;background:'.self::PRIMARY.';color:#FFFFFF;font-family:'.self::MONO_FONT.';font-size:.7rem;font-weight:600;">'.str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT).'</span>'
                .'<h4 style="margin:0 0 .4rem;font-family:'.self::HEADING_FONT.';font-size:1rem;font-weight:600;letter-spacing:-.02em;color:'.self::INK.';">'.$step['title'].'</h4>'
                .'<p style="margin:0;font-size:.9375rem;line-height:1.7;color:'.self::INK_BODY.';">'.$step['body'].'</p>'
                .'</li>';
        }

        return '<ol style="list-style:none;margin:0 0 2rem;padding:0;">'.$items.'</ol>';
    }

    /**
     * Highlighted note — compliance, standards or a caveat worth pulling out.
     */
    protected function richCallout(string $label, string $html): string
    {
        return '<aside style="margin:0 0 2rem;padding:1.25rem 1.4rem;background:'.self::SURFACE.';border:1px solid '.self::LINE.';border-left:3px solid '.self::ACCENT.';border-radius:.35rem;">'
            .'<span style="display:block;margin-bottom:.55rem;font-family:'.self::MONO_FONT.';font-size:.625rem;font-weight:600;letter-spacing:.16em;text-transform:uppercase;color:'.self::PRIMARY.';">'.$label.'</span>'
            .'<p style="margin:0;font-size:.9375rem;line-height:1.75;color:'.self::INK_BODY.';">'.$html.'</p>'
            .'</aside>';
    }

    /**
     * Pull quote for editorial content.
     */
    protected function richQuote(string $quote, ?string $attribution = null): string
    {
        $cite = $attribution
            ? '<cite style="display:block;margin-top:.85rem;font-family:'.self::MONO_FONT.';font-size:.625rem;font-style:normal;letter-spacing:.13em;text-transform:uppercase;color:'.self::INK_MUTED.';">'.$attribution.'</cite>'
            : '';

        return '<blockquote style="margin:0 0 2rem;padding:1.5rem 1.6rem;background:'.self::PRIMARY.';border-radius:.5rem;color:#FFFFFF;">'
            .'<p style="margin:0;font-family:'.self::HEADING_FONT.';font-size:1.15rem;font-weight:500;line-height:1.6;letter-spacing:-.02em;color:#FFFFFF;">'.$quote.'</p>'
            .$cite
            .'</blockquote>';
    }

    /**
     * Chip row — tools, standards or keywords.
     *
     * @param  array<int, string>  $chips
     */
    protected function richChips(string $label, array $chips): string
    {
        $items = '';

        foreach ($chips as $chip) {
            $items .= '<span style="display:inline-block;padding:.3rem .65rem;border:1px solid '.self::ACCENT.';border-radius:.25rem;background:'.self::ACCENT_SOFT.';font-family:'.self::MONO_FONT.';font-size:.625rem;letter-spacing:.1em;text-transform:uppercase;color:#076C6C;">'.$chip.'</span>';
        }

        return '<div style="margin:0 0 2rem;">'
            .'<span style="display:block;margin-bottom:.7rem;font-family:'.self::MONO_FONT.';font-size:.625rem;font-weight:600;letter-spacing:.16em;text-transform:uppercase;color:'.self::INK_MUTED.';">'.$label.'</span>'
            .'<div style="display:flex;flex-wrap:wrap;gap:.45rem;">'.$items.'</div>'
            .'</div>';
    }

    /**
     * Closing line that hands the reader to the contact panel.
     */
    protected function richClosing(string $html): string
    {
        return '<p style="margin:2.25rem 0 0;padding-top:1.5rem;border-top:1px solid '.self::LINE.';font-size:.9375rem;line-height:1.75;color:'.self::INK_MUTED.';">'.$html.'</p>';
    }
}

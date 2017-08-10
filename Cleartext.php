<?php

# Фильтрация html-текста (http://simplehtmldom.sourceforge.net)

class Cleartext {

    public function filter_text($post, $stopwords = array(), $filter_css_selector = array(), $domain) {

# загрузка контента
        $page = new simple_html_dom();
        $page->load($post);

# удаление стандартных лишних тегов (изъято из списка: object, param)
        $deltags = $page->find('iframe, doctype, html, head, body, script, style, link, meta, frameset, frame, form, fieldset, input, legend, textarea, label, button, select, optgroup, option, code, xml, noindex, comment');
        foreach ($deltags as $val1) {
            $val1->outertext = ''; # весь тег с наполнением присваиваем пустой строке
        }

# удаление селекторов фильтра
        foreach ($filter_css_selector as $val2) {
            foreach ($page->find($val2) as $val3) {
                if (is_array($val3)) {
                    foreach ($val3 as $val33) {
                        $val33->outertext = '';
                    }
                } else {
                    $val3->outertext = '';
                }
            }
        }

# удаление <a></a> у ссылок
        $delwraplinks = $page->find('a');
        foreach ($delwraplinks as $val4) {
            $val4->outertext = $val4->innertext; # innertext возвращает все что внутри тега вместе с внутренними тегами
        }

# удаление лишних аттрибутов у всех тегов
        $delattrs = $page->find('a, abbr, acronym, address, area, applet, b, basefont, bdo, big, blockquote, body, br, button, button-live, caption, center, cite, code, col, colgroup, dd, del, dfn, div, dl, dt, em, embed, fieldset, font, form, frame, frameset, h1, h2, h3, h4, h5, h6, hr, html, i, iframe, img, input, ins, kbd, label, legend, li, map, marquee, nobr, noembed, noframes, noscript, object, ol, optgroup, option, p, param, pre, q, s, samp, select, small, span, strike, strong, sub, sup, table, tbody, td, textarea, tfoot, th, thead, tr, tt, ul, var, wbr, xmp');
        foreach ($delattrs as $val5) {
            $val5->id = null;
            $val5->class = null;
            $val5->style = null;
            $val5->align = null;
            $val5->title = null;
        }

# работа с картинками
        $imgs = $page->find('img');
        foreach ($imgs as $val6) {
# устанавливаем width="100%" если ширина картинки больше 400px
            $imgwidthint = $val6->width;
            settype($imgwidthint, "int");
            if ($imgwidthint >= 400) {
                $val6->width = '100%';
            }
# удаляем height, align
            $val6->height = null;
            $val6->align = null;
# если src относительный - делаем абсолютным.
            $src = $val6->src;
            if (preg_match("~^http~is", $src) === 0) {
                $src = preg_replace('~^/~is', '', $src);
                $val6->src = 'http://' . $domain . '/' . $src;
            }
        }
# после каждой картинки добавим перевод строки, чтобы нивелировать действие флоатов | свойство display:block
        #$val6->outertext=$val6->outertext.'<br />';
        #$val5->style='display:block;';

        $result = $page->save(); # сохраняем результат в строку
        $page->clear();
        unset ($page);

# удаление стоп-слов
        foreach ($stopwords as $val7) {
            $result = preg_replace("~$val7~is", '', $result);
        }

# удаление пустых сущностей
        $result = preg_replace("~\s{2,}~is", ' ', $result);                  # больше 2-х пробелов - на 1 пробел
        $result = preg_replace("~\.{2,}~is", '.', $result);                  # больше 2-х точек - на 1 точку
        $result = preg_replace("~,{2,}~is", ',', $result);                  # больше 2-х запятых - на 1 запятую
        $result = preg_replace("~(\.)(,)~is", '.', $result);                 # ".," - на "."
        $result = preg_replace("~(,)(\.)~is", '.', $result);                 # ",." - на "."
        $result = preg_replace("~(\.)\s{0,}(,)\s{0,}(\.)~is", '.', $result); # ".,." или ". , ." - на "."
        $result = preg_replace("~(\.)\s{0,}(\.)~is", '.', $result);          # ".." или ". ." - на "."
        $result = preg_replace("~\s{1,}(\.)~is", '.', $result);              # " ." - на "."
# Удаляем пустые парные теги (также удаляет одинарные теги если они в списке!)
        $page2 = new simple_html_dom();
        $page2->load($result);
        $delemptytag = $page2->find('a, abbr, acronym, address, area, applet, b, basefont, bdo, big, blockquote, body, caption, center, cite, code, col, colgroup, dd, del, dfn, div, dl, dt, em, embed, fieldset, font, form, frame, frameset, h1, h2, h3, h4, h5, h6, hr, html, i, iframe, input, ins, kbd, label, legend, li, map, marquee, nobr, noembed, noframes, noscript, object, ol, optgroup, option, p, param, pre, q, s, samp, select, small, span, strike, strong, sub, sup, table, tbody, td, textarea, tfoot, th, thead, tr, tt, ul, var, wbr, xmp');
        foreach ($delemptytag as $val8) {
            if (preg_match("~^\s{0,}$~is", $val8->innertext) == 1) {
                $val8->outertext = '';
            }
        }
        $result = $page2->save(); # сохраняем результат в строку
        $page2->clear();
        unset ($page2);
#========================================
        #$result = preg_replace("~(<div>\s{0,}</div>)|(<span>\s{0,}</span>)|(<p>\s{0,}</p>)|(<ins>\s{0,}</ins>)~is", '', $result); # пустые теги. доп.процедура
        $result = trim($result);
        return $result;
    }

}
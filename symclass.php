<?php
/**
 * Генератор классификатора символов для Jevix
 * @author ur001 <ur001ur001@gmail.com>, http://ur001.habrahabr.ru
 *
 * В Jevix::$chClasses уже есть сгенерированный классификатор
 * Этот файл необходим только чтобы изменить правила классификации
 */

use Imaginaria\Jevix\Jevix;

require __DIR__ . '/vendor/autoload.php';

//РЕНДЕРИНГ КЛАССИФИКАТОРА СИМВОЛОВ
function addChClass(&$tbl, $chars, $class, $add = false){
	foreach($chars as $ch) {
		$ord = mb_ord($ch, 'UTF-8');
		if(!$add || !isset($tbl[$ord])){
			$tbl[$ord] = $class;
		} else {
			$tbl[$ord] = ($tbl[ $ord ] ?? 0) | $class;
		}
	}
}

function addChRangeClass(&$tbl, $chFrom, $chTo, $class, $add = false){
	for($i = $chFrom; $i<=$chTo; $i++) {
		if(!$add || !isset($tbl[$i])){
			$tbl[$i] = $class;
		} else {
			$tbl[$i] = ($tbl[ $i ] ?? 0) | $class;
		}
	}
}

addChRangeClass($tbl, 0, 0x20, Jevix::NOPRINT);
addChRangeClass($tbl, mb_ord('a', 'UTF-8'), mb_ord('z', 'UTF-8'), Jevix::ALPHA | Jevix::LAT |  Jevix::PRINTABLE | Jevix::NAME);
addChRangeClass($tbl, mb_ord('A', 'UTF-8'), mb_ord('Z', 'UTF-8'), Jevix::ALPHA | Jevix::LAT |  Jevix::PRINTABLE | Jevix::NAME);
addChRangeClass($tbl, mb_ord('а', 'UTF-8'), mb_ord('я', 'UTF-8'), Jevix::ALPHA | Jevix::PRINTABLE | Jevix::RUS);
addChRangeClass($tbl, mb_ord('А', 'UTF-8'), mb_ord('Я', 'UTF-8'), Jevix::ALPHA | Jevix::PRINTABLE | Jevix::RUS);
addChRangeClass($tbl, mb_ord('0', 'UTF-8'), mb_ord('9', 'UTF-8'), Jevix::NUMERIC | Jevix::NAME | Jevix::PRINTABLE | Jevix::URL);
addChClass($tbl, array(' ', "\t"), Jevix::SPACE);
addChClass($tbl, array("\r", "\n"), Jevix::NL, true);
addChClass($tbl, array('"'), Jevix::TAG_QUOTE  | Jevix::HTML_QUOTE | Jevix::TAG_QUOTE | Jevix::QUOTE_OPEN | Jevix::QUOTE_CLOSE| Jevix::PRINTABLE);
addChClass($tbl, array("'"), Jevix::TAG_QUOTE  | Jevix::TAG_QUOTE | Jevix::PRINTABLE);
addChClass($tbl, array('.', ',', '!', '?', ':', ';'), Jevix::PUNCTUATUON | Jevix::PRINTABLE, true);
addChClass($tbl, array('ё', 'Ё'), Jevix::ALPHA | Jevix::PRINTABLE | Jevix::RUS);
addChClass($tbl, array('/', '.', '&', '?', '%', '-', '_', '=', ';', '+', '#', '|', '@'),  Jevix::URL | Jevix::PRINTABLE, true);

ob_start();
var_export($tbl);
$res = ob_get_clean();
print str_replace(array("\n", ' '), '', $res).';';

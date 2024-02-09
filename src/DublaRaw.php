<?php
namespace dynoser\dubla;

class DublaRaw {
    public static $charSet = 
    'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿ'
  . 'ĀāĂăĄąĆćĈĉĊċČčĎďĐđĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħĨĩĪīĬĭĮįİıĲĳĴĵĶķĸĹĺĻļĽľĿ'
  . 'ŀŁłŃńŅņŇňŉŊŋŌōŎŏŐőŒœŔŕŖŗŘřŚśŜŝŞşŠšŢţŤťŦŧŨũŪūŬŭŮůŰűŲųŴŵŶŷŸŹźŻżŽžſ'
  . 'ƀ¡¢£¤¥¦§©ƉƊƋƌƍƎƏƐƑƒƓƔƕƖƗƘƙƚƛƜƝƞƟƠơƢƣƤƥƦƧƨƩƪƫƬƭƮƯưƱƲƳƴƵƶƷƸƹƺƻƼƽƾƿ'
  . 'ǀǁǂǃǄǅǆǇǈǉǊǋǌǍǎǏǐǑǒǓǔǕǖǗǘǙǚǛǜǝǞǟǠǡǢǣǤǥǦǧǨǩǪǫǬǭǮǯǰǱǲǳǴǵǶǷǸǹǺǻǼǽǾǿ'
  . 'ȀȁȂȃȄȅȆȇȈȉȊȋȌȍȎȏȐȑȒȓȔȕȖȗȘșȚțȜȝȞȟȠȡȢȣȤȥȦȧȨȩȪȫȬȭȮȯȰȱȲȳȴȵȶ®ȸȹȺȻȼȽȾȿ'
  . 'ɀɁɂɃɄɅɆɇɈɉɊɋɌɍɎɏɐɑɒɓɔɕɖɗɘəɚɛɜɝɞɟɠɡɢɣɤɥɦɧɨɩɪɫɬɭɮɯɰɱɲɳɴɵɶɷɸɹɺɻɼɽɾɿ'
  . 'ʀʁʂʃʄʅʆʇʈʉʊʋʌʍʎʏʐʑʒʓʔʕʖʗʘʙʚʛʜʝʞʟʠʡʢʣʤʥʦʧʨʩʪʫʬʭʮʯʰʱʲʳʴʵʶʷʸʹʺʻʼʽʾʿ'
  . '°±²³΄΅Ά·ΈΉΊ´ΌµΎΏΐΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡ¶ΣΤΥΦΧΨΩΪΫάέήίΰαβγδεζηθικλμνξο'
  . 'πρςστυφχψωϊϋόύώϏϐϑϒϓϔϕϖϗϘϙϚϛϜϝϞϟϠϡϢϣϤϥϦϧϨϩϪϫϬϭϮϯϰϱϲϳϴϵ϶ϷϸϹϺϻϼ¬ϾϿ'
  . 'ЀЁЂЃЄЅІЇЈЉЊЋЌЍЎЏАБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмноп'
  . 'рстуфхцчшщъыьэюяѐёђѓєѕіїјљњћќѝўџѠѡѢѣѤѥѦѧѨѩѪѫѬѭѮѯѰѱѲѳѴѵѶѷѸѹѺѻѼѽѾѿ'
  . 'Ҁҁ҂¹º¼½¾¿րҊҋҌҍҎҏҐґҒғҔҕҖҗҘҙҚқҜҝҞҟҠҡҢңҤҥҦҧҨҩҪҫҬҭҮүҰұҲҳҴҵҶҷҸҹҺһҼҽҾҿ'
  . 'ӀӁӂӃӄӅӆӇӈӉӊӋӌӍӎӏӐӑӒӓӔӕӖӗӘәӚӛӜӝӞӟӠӡӢӣӤӥӦӧӨөӪӫӬӭӮӯӰӱӲӳӴӵӶӷӸӹӺӻӼӽӾӿ'
  . 'ԀԁԂԃԄԅԆԇԈԉԊԋԌԍԎԏԐԑԒԓԔԕԖԗԘԙԚԛԜԝԞԟԠԡԢԣԤԥԦԧԨԩԪԫԬԭԮԯցԱԲԳԴԵԶԷԸԹԺԻԼԽԾԿ'
  . 'ՀՁՂՃՄՅՆՇՈՉՊՋՌՍՎՏՐՑՒՓՔՕՖւփՙ՚ք՜ֆ՞օևաբգդեզէըթժիլխծկհձղճմյնշոչպջռսվտ'
    ;

    public static $to1024 = [];        // [utf8-char] => num1024
    public static $num1024toChar = []; // [num1024]   => utf8-char
    
    public static $addPf = true;

    public static function init() {
        foreach(\str_split(self::$charSet, 2) as $num1024 => $utf8ch) {
            self::$to1024[$utf8ch] = $num1024;
            self::$num1024toChar[$num1024] = $utf8ch;
        }
    }
    
    public static function encodeBytes($data) {
        $l = \strlen($data);
        $out = self::$addPf ? ['¨'] : [];        
        for ($p = 0; $p < $l; ) {
            $byte0 = \ord($data[$p++]);
            $a = $byte0 << 2;
            if ($p < $l) {
                $byte1 = \ord($data[$p++]);
                $a += ($byte1 & 0xC0) >> 6;
                $b = ($byte1 & 0x3F) << 4;
                if ($p < $l) {
                    $byte2 = \ord($data[$p++]);
                    $b += ($byte2 & 0xF0) >> 4;
                    $c = ($byte2 & 0x0F) << 6;
                    if ($p < $l) {
                        $byte3 = \ord($data[$p++]);
                        $c += ($byte3 & 0xFC) >> 2;
                        $d = ($byte3 & 0x03) << 8;
                        if ($p < $l) {
                            $byte4 = \ord($data[$p++]);
                            $d += $byte4;
                        } else {
                            $out[] = self::$num1024toChar[$a];
                            $out[] = self::$num1024toChar[$b];
                            $out[] = self::$num1024toChar[$c];
                            $out[] = self::$num1024toChar[$d];
                            break;
                        }
                    } else {
                        $out[] = self::$num1024toChar[$a];
                        $out[] = self::$num1024toChar[$b];
                        $out[] = self::$num1024toChar[$c];
                        break;
                    }
                } else {
                    $out[] = self::$num1024toChar[$a];
                    $out[] = self::$num1024toChar[$b];
                    break;
                }
            } else {
                $out[] = self::$num1024toChar[$a];
                break;
            }
            $out[] = self::$num1024toChar[$a];
            $out[] = self::$num1024toChar[$b];
            $out[] = self::$num1024toChar[$c];
            $out[] = self::$num1024toChar[$d];
        }
        if ($l && !($l % 5) && !$byte4) {
            $out[] = '=';
        }
        if (self::$addPf) {
            $out[] = '·';
        }
        
        return \implode('', $out);
    }
    
    public static function decodeBytes($data) {
        // try cut data between ¨ ... ·
        $p = \strpos($data, '¨');
        $i = (false === $p) ? 0 : $p + 2;
        $j = \strpos($data, '·', $i);
        if ($j) {
            $data = \substr($data, $i, $j - $i);
        } elseif ($i) {
            $data = \substr($data, $i);
        }
        $out = [];
        $bytesLen = \strlen($data);
        $dataArr = [];
        for($p = 0; $p < $bytesLen; $p++) {
            $hByte = \ord($data[$p]);
            // get only valid 2-bytes chars from $data string to $dataArr, other skip
            if ($hByte > 0xC1 && $hByte < 0xD8) {
                $utfCh = \substr($data, $p++, 2);
                $dataArr[] = self::$to1024[$utfCh] ?? self::convertBadCharTo1024($utfCh);
            }
        }

        $l = \count($dataArr);
        if ($l) {
            $sub = $l % 4;
            $pad = $sub ? (5 - $sub) : 0;
            if ($pad) {
                $dataArr[] = 0;
                if ($pad > 1) {
                    $dataArr[] = 0;
                    if ($pad > 2) {
                        $dataArr[] = 0;
                    }
                }
            } else {
                $doNotDropLastZero = (\substr(\trim($data), -1) === '=');
            }

            for ($p = 0; $p < $l; ) {
                $a = $dataArr[$p++];
                $b = $dataArr[$p++];
                $c = $dataArr[$p++];
                $d = $dataArr[$p++];

                $out[] = \chr( ($a >> 2) & 0xFF );
                $out[] = \chr( (($a & 0x03) << 6) | (($b >> 4) & 0x3F) );
                $out[] = \chr( (($b & 0x0F) << 4) | (($c >> 6) & 0x0F) );
                $out[] = \chr( (($c & 0x3F) << 2) | (($d >> 8) & 0x03) );
                $out[] = \chr( $d & 0xFF );
            }
            if ($pad) {
                $out = \array_slice($out, 0, -$pad);
            } elseif (!$doNotDropLastZero && !ord($out[\count($out)-1])) {
                // When pad=0 (it meaning it is a full group of 4 chars) then remove last out-byte, if it = 0
                $out = \array_slice($out, 0, -1);
            }
        }
        return \implode('', $out);
    }
    
    public static function convertBadCharTo1024($ch) {
        // What happens if an unknown 2-bytes-utf-8 char is encountered?
        return 0;
    }
}
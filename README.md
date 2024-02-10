# Dubla

`Dubla` encoding scheme allows to almost halve the number of characters that the text takes up.

This is achieved through the use of two factors:
 1) Base-1024 charset;
 2) Compression inside (AltBase64 and/or Gzip).

### 1. Base-1024 charset.

This data encoding based on the following 1024 characters (10 bits encoded per each character space):

```php
$charSet =
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
```
The character set used consists of 1024 different 2-byte UTF-8 characters.

### 2. AltBase64 and/or Gzip inside.

AltBase64 encoding is additionally used within the Duble encoding.

Allows you to reduce the number of chars, especially effective for encoding Cyrillic text.

Optionally, the gzip compression algorithm can be used (Deflate compress 1.3, RFC 1951).

## Prefix and postix

Dubla encoding uses an optional prefix `¨` and postfix `·` to indicate where the encoded data begins and ends.
If these delimiters are present, then only the characters between them are used during decoding.
These symbols are used only to facilitate visual and automatic recognition of the locations where Dubla encoded data resides

## Example

```text
Man is distinguished, not only by his reason, but by this singular passion from
other animals, which is a lust of the mind, that by a  perseverance of delight in
the continued and indefatigable generation  of knowledge, exceeds the short vehemence
of any carnal pleasure
```

Dubla encoded:
```text
¨ҔјոɱҌ°ҠӗӄÅϩȃƢΈûґϏýÍћƿŏȫҬʶǥփϐǝȎ՚ϩСϼɃȖƮЩȆջδՌգʢӔӮҨүФѼӥԿǣòȻϚõĺщӪҽсôӓΩѿΙÍʤȐβѰäՖɦøӕϤѳղԀāʦճҴϡ
ɮüυĕƻϐʯъĶϜƜɂʎĎ§ҩëωՙâǶьՔӖÁѿбևИբÙև¦ʽÅԊԫʣҷƉƯҊфɴĦω¼ȞɞԣՄʰ·
```

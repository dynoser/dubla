<?php
namespace dynoser\dubla;

class Dubla extends DublaRaw {
    
    public static function decode($str) {
        $bytesStr = DublaRaw::decodeBytes($str);
        if (\substr($bytesStr, 0, 1) === \chr(196)) {
            return \substr($bytesStr, 1);
        }
        $b64str = \base64_encode($bytesStr);
        $b64len = \strlen($b64str);
        $newLen = $b64len;
        while($newLen && $b64str[$newLen-1] === '=') {
            $newLen--;
        }
        switch($newLen % 3) {
            case 1:
                $newLen -= 1;
                break;
            case 2:
                $newLen -= 1;
        }
        if ($newLen !== $b64len) {
            $b64str = \substr($b64str, 0, $newLen);
        }
        $b64chars = \substr(AltBase64::$base64cs, 0, 62) . '+/';
        $numArr = \array_fill(0, $newLen, 0);
        for($i = 0; $i < $newLen; $i++) {
            $numArr[$i] = \strpos($b64chars, $b64str[$i]);
        }
        
        AltBase64::$keys4Arr || AltBase64::init();
        $charsArr = AltBase64::decodeBytes($numArr);
        return \implode('', $charsArr);
    }
    
    public static function encode($str) {
        $len = \strlen($str);
        $num64arr = AltBase64::encodeBytes($str, 4 * $len / 3);
        if ($num64arr) {
            // successful encoded into AltBase64
            $bytesStr = self::Num64ArrToBytes($num64arr, 51);
        } else {
            // encode in binary-mode with 49-low 6-bit AltBase64 prefix 
            $bytesStr = \chr(196) . $str;
        }
        return DublaRaw::encodeBytes($bytesStr);
    }
    
    public static function Num64ArrToBytes($num64Arr, $padNum64 = 0) {
        $len = \count($num64Arr);
        $sub = $len % 4;
        if ($sub & 1) {
          $num64Arr[] = $padNum64;
          $len++;
        }

        $out = [];
        $i = 0;
        while ($i < $len) {
            $o1 = $num64Arr[$i++];
            $o2 = $i < $len ? $num64Arr[$i++] : 0;
            $o3 = $i < $len ? $num64Arr[$i++] : 0;
            $o4 = $i < $len ? $num64Arr[$i++] : 0;

            $bits = ($o1 << 18) | ($o2 << 12) | ($o3 << 6) | $o4;

            $out[] = \chr(($bits >> 16) & 255);
            $out[] = \chr(($bits >> 8)  & 255);
            $out[] = \chr( $bits        & 255);
        }

        if ($len % 4 === 2) { // remove last element
            \array_pop($out);
        }

        return \implode('', $out);
  }
}
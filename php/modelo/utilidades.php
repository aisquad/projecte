<?php
    function array_to_xml(array $vector, $elemento='producto') {
        //Función que convierte un vector a objeto XML.
        $xml = new SimpleXMLElement("<$elemento/>");
        foreach ($vector as $k => $v) {
            is_array($v)
                ? array_to_xml($v, $xml->addChild($k))
                : $xml->addChild($k, utf8_encode($v));
        }
        return $xml->asXML();
    }

    function assocarray_to_xml($from, SimpleXMLelement $parent = null, $tagName = null) {
        // Función que convierte un vector asociativo en objeto XML.
        if (!is_array($from)) {
            if ($tagName === null) {
                $parent[0] = (string) $from;
            } else {
                $parent->addChild($tagName, (string) $from);
            }
            return $parent->asXML();
        }

        foreach ($from as $key => $value) {
            if (is_string($key)) {
                if ($parent === null) {
                    $parent = new SimpleXMLElement("<$key/>");
                    assocarray_to_xml($value, $parent);
                    break;
                }
                assocarray_to_xml($value, $parent, $key);
            } else {
                assocarray_to_xml($value, $parent->addChild($tagName));
            }
        }
        return $parent->asXML();
    }

    function utf8_urldecode($str) {
        // Función para pasar texto codificado de URIComponent a entidades HTML.
        $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;", urldecode($str));
        return html_entity_decode($str,null,'UTF-8');
    }
?>    
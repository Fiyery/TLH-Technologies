<?php
/**
 * String regroupe des fonctions utiles sur les chaînes de caractères.
 * @author Yoann Chaumin <yoann.chaumin@gmail.com>
 * @version 1.0
 * @copyright 2011-2014 Yoann Chaumin
 */
class String
{
    /**
     * Formate une chaine pour la mettre dans l'url.
     * @param string $string Chaîne de caractères à traiter.
     * @return string Chaîne formatée.
     */
    public static function format_url($string)
    {
    	return self::format($string,'_');
    }
    
    /**
     * Formate une chaine en enlevant tous les caractères spéciaux.
     * @param string $string Chaîne de caractères à traiter.
     * @param char $space Caractère de remplacement des espaces.
     * @return string Chaîne formatée.
     */
    public static function format($string, $space='')
    {
        $special_char = array('À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ò','Ó','Ô','Õ','Ö','Ù','Ú','Û','Ü','Ý','à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ð','ò','ó','ô','õ','ö','ù','ú','û','ü','ý','ÿ');
        $normal_char = array('A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','O','O','O','O','O','U','U','U','U','Y','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','o','u','u','u','u','y','y');
    	$string = str_replace($special_char, $normal_char, $string);
    	$string = preg_replace('/[^\w\s]/','',$string);
		$string = trim($string);
		$string = str_replace('  ',' ',$string, $count);
		while ($count > 0)
		{
			$string = str_replace('  ',' ',$string, $count);
		}
    	$string = str_replace(' ',$space,$string);
    	$string = strtolower($string);
    	return $string;
    }
}
?>
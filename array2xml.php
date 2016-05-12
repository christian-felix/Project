<?php


$xml = new DOMDocument('1.0', 'UTF-8');
$xmlRoot = $xml->createElement('schaden');

$iterator = new RecursiveArrayIterator($this->resultContainer);
iterator_apply($iterator, 'Generator::createNode', array($iterator,
$xml, $xmlRoot));


/**
* erzeugt XML Nodes
*
* @param ArrayIterator  $iterator
* @param DomDocument    $xml
* @param DomElement     $root
*/
public static function createNode($iterator, $xml, $root){

while($iterator->valid()){
if($iterator->hasChildren()){
if(is_int($iterator->key())){
self::createNodeAccumulated($iterator->getChildren(), $xml, $root);
}else{

$node = $xml->createElement($iterator->key());
$root->appendChild($node);
self::createNodeAccumulated($iterator->getChildren(), $xml, $node);
}
}else{
$node = $xml->createElement($iterator->key(),
$iterator->current());
$root->appendChild($node);
}
$iterator->next();
}
}
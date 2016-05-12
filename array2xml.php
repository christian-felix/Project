<?php


/**
 * Class Generator
 *
 * @date: 12.05.2016
 * @last_update: 12.05.2016
 */
class Generator
{


    protected $resultContainer = array();


    /**
     *   setup  resultContainer data
     */
    public function setupContainerData(){

        //TODO:

    }

    /**
     *  generate XML File
     */
    public function generateXML(){

        $xml = new DOMDocument('1.0', 'UTF-8');
        $xmlRoot = $xml->createElement('schaden');

        $iterator = new RecursiveArrayIterator($this->resultContainer);
        iterator_apply($iterator, 'Generator::createNode', array($iterator, $xml, $xmlRoot));

        $xml->save('test.xml');
    }


    /**
     * erzeugt XML Nodes
     *
     * @param ArrayIterator $iterator
     * @param DomDocument $xml
     * @param DomElement $root
     */
    public static function createNode($iterator, $xml, $root)
    {

        while ($iterator->valid()) {
            if ($iterator->hasChildren()) {
                if (is_int($iterator->key())) {
                    self::createNode($iterator->getChildren(), $xml, $root);
                } else {

                    $node = $xml->createElement($iterator->key());
                    $root->appendChild($node);
                    self::createNodeA($iterator->getChildren(), $xml, $node);
                }
            } else {
                $node = $xml->createElement($iterator->key(),
                    $iterator->current());
                $root->appendChild($node);
            }
            $iterator->next();
        }
    }


}


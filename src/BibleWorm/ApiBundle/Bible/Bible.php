<?php

namespace BibleWorm\ApiBundle\Bible;

use BibleWorm\ApiBundle\Bible\BookIndex as Index;

/**
 * Models the books, chapters, and verse counts of the Bible
 */
class Bible
{
    protected $translations = array();
    
    public $books = array();
    
    
    function __construct()
    {
        $this->books = $this->getBooks();
    }
    
    
    public function addTranslation($translation)
    {
        $this->translations[$translation->getName()] = $translation;
    }
    
    
    public function getTranslation($name)
    {
        if (array_key_exists($name, $this->translations)) {
            return $this->translations[$name];
        } else {
            throw new \Exception(sprintf("Translation '%s' doesn't exist", $name));
        }
    }
    
    public function getTranslations()
    {
        return $this->translations;
    }
    
    /**
     * Builds and returns an array of meta data for each book.
     * It only has to be built a single time because the data
     * doesn't change
     */
    public function getBooks()
    {
        if (empty($this->books))
        {
            $count = 0;
            foreach (Index::getCanon() as $book)
            {
                $name = $book[0];
                $id = $book[1];
                $chaptersArr = $book[2];
                
                $this->books[$name] = array(
                    'name' => $name,
                    'osis_id' => $id,
                    'chapters' => $chaptersArr,
                    'chapter_count' => count($chaptersArr),
                    'order' => $count
                );
                $count++;
            }
        }
        
        return $this->books;
    }
    
    /**
     * Returns an array of book names
     */
    public function getBookNames()
    {
        return array_keys($this->getBooks());
    }
    
    
    public function getOsisIds()
    {
        $ids = array();
        foreach ($this->getBooks() as $name => $attrs)
        {
            $ids[$name] = $attrs['osis_id'];
        }
        
        return $ids;
    }
    
    
    public function getNextBook($bookName)
    {
        return $this->getSiblingBook($bookName, 1);
    }
    
    
    public function getPrevBook($bookName)
    {
        return $this->getSiblingBook($bookName, -1);
    }
    
    
    public function getSiblingBook($bookName, $increment)
    {
        $books = $this->getBooks();
        $order = $books[$bookName]['order'] + $increment;
        
        if ($order < 0 || $order < count($books))
        {
            return false;
        }
        
        $bookNames = array_keys($books);
        
        return $bookNames[$order];
    }
}

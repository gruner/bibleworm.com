<?php

namespace BibleWorm\MobileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BibleController extends Controller
{
    public function getIndexAction()
    {
        $bible = $this->get('bw_api.bible');
        
        return $this->render('BibleWormMobileBundle:Bible:index.html.twig', array(
            'books' => $bible->getBookNames()
        ));
    }
    
    public function getBookAction($book)
    {
        $bible = $this->get('bw_api.bible');
        $books = $bible->getBooks();
        
        if (!array_key_exists($book, $books)) {
            # 404
        }
        
        return $this->render('BibleWormMobileBundle:Bible:book.html.twig', array(
            'book' => $book,
            'chapter_count' => $books[$book]['chapter_count']
        ));
    }
    
    public function getChapterAction($book, $chapter)
    {
        $bible = $this->get('bw_api.bible');
        $books = $bible->getBooks();
        
        if (!array_key_exists($book, $books)) {
            # 404
        }
        
        $bookInfo = $books[$book];
        
        $prevChapter = ($chapter > 1) ? $chapter - 1 : false;
        $nextChapter = ($chapter + 1 <= $bookInfo['chapter_count']) ? $chapter + 1 : false;
        
        $passage = $bible->getTranslation('ESV')->lookup($book.$chapter);
        
        return $this->render('BibleWormMobileBundle:Bible:chapter.html.twig', array(
            'book' => $book,
            'chapter' => $chapter,
            'prev_chapter' => $prevChapter,
            'next_chapter' => $nextChapter,
            'passage' => $passage
        ));
    }
}

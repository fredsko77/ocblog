<?php 

namespace App\Services;

class Pagination 
{
                                                                                                                                                                                                        
     private $nbPages;
     private $currentPage;

     public function __construct(float $nbPages,float $currentPage)
     {
          $this->nbPages = $nbPages;
          $this->currentPage = $currentPage;
     }

     public function pages()
     {
          $page = '';

          for( (float) $i = 0; $i < $this->nbPages; $i++ ) {
               $url = $i === 0 ? generate_url('blog') : generate_url('blog.paginate', ['id' => $i]);
               $active = $i === (int) $this->currentPage ? 'active' : '';
               $page .=   "<li class=\"page {$active}\"> \r\n
                              <a href=\"{$url}\"> {$i} </a> \r\n
                         </li> \r\n";
          }
          return $page ; 
     }

     public function create()
     {
          $previous = $this->currentPage === 0 ? generate_url('blog') : generate_url('blog.paginate', ['id' => ( $this->currentPage - 1 ) ]);
          $next = generate_url('blog.paginate', ['id' => ( $this->currentPage + 1 ) ]);
          $pagination = "<span class=\"pagination\">\r\n";
          if ( $this->currentPage > 0 ) $pagination .= "<div class=\"page\"> \r\n <a href=\"{$previous}\"><i class=\"icofont-curved-double-left\"></i></a> \r\n </div>\r\n";
          $pagination .= "{$this->pages()}";
          if ( $this->currentPage < ($this->nbPages - 1) ) $pagination .= "<div class=\"page\"> \r\n 
                              <a href=\"{$next}\"><i class=\"icofont-curved-double-right\"></i></a> \r\n
                         </div>\r\n";
          $pagination .= "</span>";
          return esc_html( $pagination );
     }

}
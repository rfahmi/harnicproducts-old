<?php
function paginate($item_per_page, $current_page, $total_records, $total_pages, $page_url)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= "<nav aria-label='Page navigation example'>";
        $pagination .= "<ul class='pagination justify-content-end'>";
        
        $right_links    = $current_page + 3; 
        $previous       = $current_page - 1; //previous link 
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
        
        if($current_page > 1){
            $previous_link = ($previous==0)?1:$previous;

            $pagination .= "<li class='page-item'><a class='page-link' href='".$page_url."/".$previous_link."'>Previous</a></li>";
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= "<li class='page-item'><a class='page-link' href='".$page_url."/".$i."'>".$i."</a></li>";
                    }
                }   
            $first_link = false; //set first link to false
        }
        
        if($first_link){ //if current active page is first link
            $pagination .= "<li class='page-item disabled'><a class='page-link' href=''>".$current_page."</a></li>";
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= "<li class='page-item disabled'><a class='page-link' href=''>".$current_page."</a></li>";
        }else{ //regular current link
            $pagination .= "<li class='page-item disabled'><a class='page-link' href='".$page_url."/".$i."'>".$current_page."</a></li>";
        }
                
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= "<li class='page-item'><a class='page-link' href='".$page_url."/".$i."'>".$i."</a></li>";
            }
        }
        if($current_page < $total_pages){ 
                $next_link = ($i > $total_pages)? $total_pages : $i;
                $pagination .= "<li class='page-item'><a class='page-link' href='".$page_url."/".$next_link."'>Next</a></li>";
        }
        
        $pagination .= '</ul>'; 
    }
    return $pagination; //return pagination links
}
function findCategory($id){
    global $link;
    $object=$link->query("SELECT * FROM mstkategori WHERE kategori_id=".$id."")->fetch_object();
    return $object;
}
?>
<?php 
namespace App\Services\AjaxPagination;
 
class AjaxPagination {
 
    public function getPagination($data, $currentPage, $perPage = 10, $showPages = 5) {
        $totalPages = ceil($data->total() / $perPage);

        if ($currentPage < 1) {
            $currentPage = 1;
        } elseif ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }

        $startPage = max(1, $currentPage - floor($showPages / 2));
        $endPage = min($totalPages, $startPage + $showPages - 1);

        $pagination_html = '<ul class="pagination">';

        if ($currentPage > 0) {
            $pagination_html .= '<li class="page-item ' . ($currentPage == 1 ? 'disabled' : '') . '">
                <a class="page-link shadow" id="prev_page" index="' . ($currentPage - 1) . '" href="" tabindex="-1" aria-disabled="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-chevron-left undefined"><path d="M13 16L7.35355 10.3536C7.15829 10.1583 7.15829 9.84171 7.35355 9.64645L13 4"></path></svg>
                </a>
            </li>';
        } 

        for ($i = $startPage; $i <= $endPage; $i++) {
            $pagination_html .= '<li class="page-item' . ($currentPage == $i ? ' active' : '') . '">
                <a class="page-link shadow page" href="" index="' . $i . '">' . $i . '</a>
            </li>';
        }

        if ($currentPage < $totalPages) {
            $pagination_html .= '<li class="page-item">
                <a class="page-link shadow" id="next_page" index="' . ($currentPage + 1) . '" last-index="' . $totalPages . '">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-chevron-right undefined"><path d="M7 4L12.6464 9.64645C12.8417 9.84171 12.8417 10.1583 12.6464 10.3536L7 16"></path></svg>
                </a>
            </li>';
        } else {
            $pagination_html .= '<li class="page-item disabled">
                <span class="page-link shadow" id="next_page" tabindex="-1" aria-disabled="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-chevron-right undefined"><path d="M7 4L12.6464 9.64645C12.8417 9.84171 12.8417 10.1583 12.6464 10.3536L7 16"></path></svg>
                </span>
            </li>';
        }

        $pagination_html .= '</ul>';

        return $pagination_html;
    }

 
}
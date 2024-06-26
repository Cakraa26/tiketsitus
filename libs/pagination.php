<?php

function make_pagination_numbering($perPage, $page, $index)
{
  // jika masih di halaman pertama
  // maka cukup $index ditambah 1
  if ($page === 1) {
    return $index + 1;
  }

  // jika di halaman kedua keatas
  // misal index ke 0, maka akan menjadi 11
  // ((2 - 1) * 10) + (0 + 1) = 11
  return (($page - 1) * $perPage) + ($index + 1);
}

/**
 * fungsi ini akan menghasilkan pagination seperti berikut
 * <nav aria-label="Page navigation example">
 *   <ul class="pagination justify-content-center">
 *    <li class="page-item">
 *      <a class="page-link" href="?page=1" aria-label="Previous">
 *        <span aria-hidden="true">&laquo;</span>
 *      </a>
 *    </li>
 *    <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
 *    <li class="page-item"><a class="page-link" href="?page=2">2</a></li>
 *    <li class="page-item"><a class="page-link" href="?page=3">3</a></li>
 *    <li class="page-item"><a class="page-link" href="?page=4">4</a></li>
 *    <li class="page-item"><a class="page-link" href="?page=5">5</a></li>
 *    <li class="page-item">
 *      <a class="page-link" href="?page=2" aria-label="Next">
 *        <span aria-hidden="true">&raquo;</span>
 *      </a>
 *    </li>
 *   </ul>
 * </nav>
 */
function build_pagination($totalData, $perPage, $currentPage)
{
  $totalPage = ceil($totalData / $perPage);

  $pagination = '';

  if ($totalPage > 1) {
    $pagination .= '<nav aria-label="Page navigation example">';
    $pagination .= '<ul class="pagination justify-content-center">';

    // membuat tombol prev
    if ($currentPage > 1) {
      $pagination .= '<li class="page-item">';
      $pagination .= '<a class="page-link" href="?page=' . ($currentPage - 1) . '" aria-label="Previous">';
      $pagination .= '<span aria-hidden="true">&laquo;</span>';
      $pagination .= '</a>';
      $pagination .= '</li>';
    }

    // membuat pagination
    for ($i = 1; $i <= $totalPage; $i++) {
      if ($i === $currentPage) {
        $pagination .= '<li class="page-item active"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
      } else {
        $pagination .= '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
      }
    }

    // membuat tombol next
    if ($currentPage < $totalPage) {
      $pagination .= '<li class="page-item">';
      $pagination .= '<a class="page-link" href="?page=' . ($currentPage + 1) . '" aria-label="Next">';
      $pagination .= '<span aria-hidden="true">&raquo;</span>';
      $pagination .= '</a>';
      $pagination .= '</li>';
    }

    $pagination .= '</ul>';
    $pagination .= '</nav>';
  }

  return $pagination;
}
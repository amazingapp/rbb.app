<?php
namespace Banijya\Paginator;


use Illuminate\Pagination\BootstrapThreePresenter;
use Illuminate\Pagination\Paginator;
class FriendsPaginator extends BootstrapThreePresenter
{

  /**
   * Create a simple Bootstrap 3 presenter.
   *
   * @param  \Illuminate\Contracts\Pagination\Paginator  $paginator
   * @return void
   */
  public function __construct(Paginator $paginator)
  {
      $this->paginator = $paginator;
  }

  /**
   * Determine if the underlying paginator being presented has pages to show.
   *
   * @return bool
   */
  public function hasPages()
  {
      return $this->paginator->hasPages() && count($this->paginator->items()) > 0;
  }

  /**
   * Convert the URL window into Bootstrap HTML.
   *
   * @return string
   */
  public function render()
  {
      if ($this->hasPages()) {
          return sprintf(
              '<ul class="pager">%s %s</ul>',
              $this->getPreviousButton('Previous'),
              $this->getNextButton('Next')
          );
      }

      return '';
  }
}
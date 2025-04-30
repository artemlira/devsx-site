jQuery(document).ready(function($) {
  const loadMoreBtn = $('#load-more');
  const postsContainer = $('#blog-posts-container');
  const loadingSpinner = $('#loading-spinner');
  const noResultsContainer = $('.no-results');

  function loadPosts(page = 1, search = '', tag = '', resetContainer = false) {
    loadingSpinner.show();

    if (resetContainer) {
      postsContainer.empty();
      if (noResultsContainer.length) {
        noResultsContainer.remove();
      }
    }

    $.ajax({
      url: blogLoadMore.ajaxurl,
      type: 'POST',
      data: {
        action: 'devsx_load_more_posts',
        nonce: blogLoadMore.nonce,
        page: page,
        search: search,
        tag: tag
      },
      success: function(response) {
        if (response.success) {
          if (response.data.html) {
            postsContainer.append(response.data.html);

            postsContainer.show();
            loadMoreBtn.data('page', page);
            loadMoreBtn.data('search', search);
            loadMoreBtn.data('tag', tag);

            if (response.data.has_more) {
              loadMoreBtn.parent().show();
              loadMoreBtn.show();
            } else {
              loadMoreBtn.parent().hide();
            }
          } else if (resetContainer) {
            postsContainer.after('<div class="no-results"><p>' +
              (search ? 'Nothing found for your search "' + search + '".' : 'No records found.') +
              '</p><p>Try changing your search query or resetting your filters.</p></div>');

            loadMoreBtn.parent().hide();
          }

          if (resetContainer) {
            let newUrl = window.location.pathname;
            let queryParams = [];

            if (search) queryParams.push('s=' + encodeURIComponent(search));
            if (tag) queryParams.push('tag=' + encodeURIComponent(tag));

            if (queryParams.length > 0) {
              newUrl += '?' + queryParams.join('&');
            }

            window.history.pushState({path: newUrl}, '', newUrl);
          }
        } else {
          console.error('Error loading posts:', response.data);
        }
      },
      error: function(xhr, status, error) {
        console.error('AJAX request error:', error);
      },
      complete: function() {
        loadingSpinner.hide();
        loadMoreBtn.prop('disabled', false);
      }
    });
  }

  loadMoreBtn.on('click', function() {
    const nextPage = parseInt($(this).data('page')) + 1;
    const searchQuery = $(this).data('search');
    const tagSlug = $(this).data('tag');

    loadMoreBtn.prop('disabled', true);

    loadPosts(nextPage, searchQuery, tagSlug, false);
  });

  $('.blog-filter-link').on('click', function(e) {
    e.preventDefault();

    $('.blog-filter-item').removeClass('active');
    $(this).parent().addClass('active');

    const isAllButton = $(this).parent().index() === 0;
    let searchQuery, tagSlug;

    if (isAllButton) {
      searchQuery = $('.blog-search-field').val() || '';
      tagSlug = '';
    } else {
      const url = new URL($(this).attr('href'));
      searchQuery = url.searchParams.get('s') || '';
      tagSlug = url.searchParams.get('tag') || '';
    }
    loadPosts(1, searchQuery, tagSlug, true);
  });

  $('.blog-search-form').on('submit', function(e) {
    e.preventDefault();
    const searchQuery = $(this).find('.blog-search-field').val();
    const tagSlug = $('input[name="tag"]').val() || '';
    loadPosts(1, searchQuery, tagSlug, true);
  });
});
// jQuery(document).ready(function($) {
//   // Находим кнопку "Загрузить еще"
//   const loadMoreBtn = $('#load-more');
//   // Находим контейнер для постов
//   const postsContainer = $('#blog-posts-container');
//   // Находим индикатор загрузки
//   const loadingSpinner = $('#loading-spinner');
//
//   // Обработчик клика на кнопку "Загрузить еще"
//   loadMoreBtn.on('click', function() {
//     // Получаем текущую страницу
//     let currentPage = parseInt($(this).data('page'));
//     // Увеличиваем номер страницы
//     const nextPage = currentPage + 1;
//     // Получаем максимальное количество страниц
//     const maxPages = parseInt($(this).data('max'));
//     // Получаем параметры поиска и фильтрации
//     const searchQuery = $(this).data('search');
//     const tagSlug = $(this).data('tag');
//
//     // Показываем индикатор загрузки
//     loadingSpinner.show();
//     // Отключаем кнопку во время загрузки
//     loadMoreBtn.prop('disabled', true);
//
//     // Отправляем AJAX-запрос
//     $.ajax({
//       url: blogLoadMore.ajaxurl,
//       type: 'POST',
//       data: {
//         action: 'devsx_load_more_posts',
//         nonce: blogLoadMore.nonce,
//         page: nextPage,
//         search: searchQuery,
//         tag: tagSlug
//       },
//       success: function(response) {
//         if (response.success) {
//           // Добавляем новые посты в контейнер
//           postsContainer.append(response.data.html);
//
//           // Обновляем номер текущей страницы
//           loadMoreBtn.data('page', nextPage);
//
//           // Скрываем кнопку, если достигли последней страницы
//           if (!response.data.has_more || nextPage >= maxPages) {
//             loadMoreBtn.hide();
//           }
//
//           // Плавный скролл к новым постам
//           if (response.data.html) {
//             $('html, body').animate({
//               scrollTop: $(window).scrollTop() + 400
//             }, 500);
//           }
//         } else {
//           console.error('Ошибка загрузки постов:', response.data);
//         }
//       },
//       error: function(xhr, status, error) {
//         console.error('Ошибка AJAX-запроса:', error);
//       },
//       complete: function() {
//         // Скрываем индикатор загрузки
//         loadingSpinner.hide();
//         // Включаем кнопку
//         loadMoreBtn.prop('disabled', false);
//       }
//     });
//   });
// });
function initCardsAnimation() {
  if (typeof jQuery === 'undefined') {
    console.error('jQuery не загружен');
    return;
  }

  jQuery(document).ready(function ($) {
    // Проверяем, загружен ли уже GSAP
    if (typeof gsap === 'undefined') {
      // Загружаем GSAP и ScrollTrigger
      loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', function () {
        loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', setupAnimation);
      });
    } else if (typeof gsap.ScrollTrigger === 'undefined') {
      // Загружаем только ScrollTrigger, если GSAP уже загружен
      loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', setupAnimation);
    } else {
      // И GSAP, и ScrollTrigger уже загружены
      setupAnimation();
    }

    // Функция для загрузки скриптов
    function loadScript(src, callback) {
      const script = document.createElement('script');
      script.src = src;
      script.onload = callback;
      document.head.appendChild(script);
    }

    // Настройка анимации с GSAP
    function setupAnimation() {
      // Регистрируем плагин ScrollTrigger
      gsap.registerPlugin(ScrollTrigger);

      const section = $('#cards-showcase');
      const wrapper = $('.cards-wrapper');
      const cards = $('.card-item');
      const totalCards = cards.length;

      if (totalCards === 0) return;

      // Увеличиваем высоту секции, чтобы дать больше места для анимации всех карточек
      // Особенно важно для последней карточки, чтобы она успела завершить анимацию
      const sectionHeight = (totalCards * 75) + 250; // Увеличенное значение
      section.css('height', sectionHeight + 'vh');

      // Создаем фиксацию wrapper при скролле с увеличенным end
      // Важно: меняем end на "bottom bottom", чтобы pin закончился только на самом конце секции
      ScrollTrigger.create({
        trigger: section,
        start: 'top top',
        end: 'bottom bottom',
        pin: wrapper,
        pinSpacing: false,
        // Добавляем markers для отладки (можно удалить в продакшне)
        // markers: true,
        onUpdate: (self) => {
          // console.log('Progress:', self.progress);
        }
      });

      // Сначала скрываем все карточки и устанавливаем их в начальное положение
      gsap.set(cards, {
        opacity: 0,
        visibility: 'hidden',
        y: '100vh' // Начальное положение - за пределами экрана снизу
      });

      // Высота видимого смещения для стекирования карточек
      const visibleHeaderHeight = 70; // в пикселях

      // Получаем высоту контейнера для точных расчетов
      const containerHeight = wrapper.height();

      // Устанавливаем абсолютное начальное положение карточек для точного контроля
      cards.css({
        'position': 'absolute',
        'left': '0',
        'right': '0',
        'top': '0' // Начальная позиция от верха контейнера
      });

      // Проходимся по каждой карточке в обратном порядке
      $(cards.get().reverse()).each(function (reversedIndex) {
        const card = $(this);
        const index = totalCards - 1 - reversedIndex; // Восстанавливаем оригинальный индекс

        // Устанавливаем z-index: первая карточка должна быть внизу стопки
        card.css('z-index', index + 1);

        // Финальная позиция карточки
        const finalPosition = index * visibleHeaderHeight;

        // Переработанная система распределения точек начала и конца анимации
        // Равномерно распределяем карточки по всей высоте секции
        // При этом последняя карточка должна успеть полностью доехать до конца

        // Рассчитываем общий прогресс для анимации (от 0 до 90%)
        // Оставляем 10% в конце для завершения всех анимаций
        const progressRange = 90; // Используем только 90% общего скролла секции

        // Равномерно распределяем карточки по диапазону progressRange
        const cardStep = progressRange / totalCards;

        // Начальная точка анимации для данной карточки (в %)
        const startProgress = 10 + (index * cardStep);

        // Конечная точка анимации (+15% от шага для плавного перехода между карточками)
        // Для последней карточки даем немного больше времени
        const endProgress = startProgress + (index === totalCards - 1 ? cardStep * 1.5 : cardStep * 1.2);

        // Создаем timeline для анимации появления карточки
        const cardTl = gsap.timeline({
          scrollTrigger: {
            trigger: section,
            start: `top+=${startProgress}% top`,
            end: `top+=${endProgress}% top`,
            scrub: 0.8, // Уменьшаем задержку для более точной анимации
            toggleActions: 'play none none reverse',
            // Для отладки (можно удалить в продакшне)
            // markers: true,
            // id: `card-${index}`
          }
        });

        // Анимация появления карточки с точным позиционированием
        cardTl.fromTo(card,
          {
            y: containerHeight,
            opacity: 0,
            visibility: 'hidden'
          },
          {
            y: finalPosition,
            opacity: 1,
            visibility: 'visible',
            duration: 1,
            ease: 'power2.out',
            immediateRender: false
          }
        );
      });

      // Пересчитываем при изменении размера окна
      $(window).on('resize', function () {
        ScrollTrigger.refresh(true);
      });
    }
  });
}

// Запускаем инициализацию
initCardsAnimation();

// Проверяем, загружен ли уже GSAP и ScrollTrigger====================================================================
// function initCardsAnimation() {
//   if (typeof jQuery === 'undefined') {
//     console.error('jQuery не загружен');
//     return;
//   }
//
//   jQuery(document).ready(function ($) {
//     // Проверяем, загружен ли уже GSAP
//     if (typeof gsap === 'undefined') {
//       // Загружаем GSAP и ScrollTrigger
//       loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', function () {
//         loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', setupAnimation);
//       });
//     } else if (typeof gsap.ScrollTrigger === 'undefined') {
//       // Загружаем только ScrollTrigger, если GSAP уже загружен
//       loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', setupAnimation);
//     } else {
//       // И GSAP, и ScrollTrigger уже загружены
//       setupAnimation();
//     }
//
//     // Функция для загрузки скриптов
//     function loadScript(src, callback) {
//       const script = document.createElement('script');
//       script.src = src;
//       script.onload = callback;
//       document.head.appendChild(script);
//     }
//
//     // Настройка анимации с GSAP
//     function setupAnimation() {
//       // Регистрируем плагин ScrollTrigger
//       gsap.registerPlugin(ScrollTrigger);
//
//       const section = $('#cards-showcase');
//       const wrapper = $('.cards-wrapper');
//       const cards = $('.card-item');
//       const totalCards = cards.length;
//
//       if (totalCards === 0) return;
//
//       // Устанавливаем высоту секции в зависимости от количества карточек
//       // Компромиссное значение для достаточного пространства скролла
//       const sectionHeight = (totalCards * 60) + 200;
//       section.css('height', sectionHeight + 'vh');
//
//       // Создаем фиксацию wrapper при скролле
//       ScrollTrigger.create({
//         trigger: section,
//         start: 'top top',
//         end: 'bottom bottom',
//         pin: wrapper,
//         pinSpacing: false
//       });
//
//       // Сначала скрываем все карточки и устанавливаем их в начальное положение
//       gsap.set(cards, {
//         opacity: 0,
//         visibility: 'hidden',
//         y: '100vh' // Начальное положение - за пределами экрана снизу
//       });
//
//       // Высота видимого смещения для стекирования карточек
//       const visibleHeaderHeight = 70; // в пикселях
//
//       // Получаем высоту контейнера для точных расчетов
//       const containerHeight = wrapper.height();
//
//       // Устанавливаем абсолютное начальное положение карточек для точного контроля
//       cards.css({
//         'position': 'absolute',
//         'left': '0',
//         'right': '0',
//         'top': '0' // Начальная позиция от верха контейнера
//       });
//
//       // Проходимся по каждой карточке
//       // Важно: мы проходим по карточкам в обратном порядке, чтобы правильно настроить z-index
//       // Это обеспечит правильное наложение карточек друг на друга
//       $(cards.get().reverse()).each(function (reversedIndex) {
//         const card = $(this);
//         const index = totalCards - 1 - reversedIndex; // Восстанавливаем оригинальный индекс
//
//         // Устанавливаем z-index: первая карточка должна быть внизу стопки
//         card.css('z-index', index + 1);
//
//         // Финальная позиция карточки
//         const finalPosition = index * visibleHeaderHeight;
//
//         // Определяем точки начала и конца для анимации каждой карточки
//         // Возвращаем к исходным значениям, но с небольшими корректировками
//         let startScroll, endScroll;
//
//         // Для всех карточек кроме последней - стандартные интервалы
//         if (index < totalCards - 1) {
//           startScroll = 10 + (index * 20); // Вернулись к исходным значениям
//           endScroll = startScroll + 30;
//         }
//         // Для последней карточки - добавляем немного больше пространства
//         else {
//           startScroll = 10 + (index * 25);
//           endScroll = startScroll + 35; // Чуть больше времени для завершения
//         }
//
//         // Создаем timeline для анимации появления карточки
//         const cardTl = gsap.timeline({
//           scrollTrigger: {
//             trigger: section,
//             start: `top+=${startScroll}% top`,
//             end: `top+=${endScroll}% top`,
//             scrub: 1.2, // Немного меньше задержки для более отзывчивой анимации
//             toggleActions: 'play none none reverse'
//           }
//         });
//
//         // Анимация появления карточки с точным позиционированием
//         cardTl.fromTo(card,
//           {
//             y: containerHeight,
//             opacity: 0,
//             visibility: 'hidden'
//           },
//           {
//             y: finalPosition,
//             opacity: 1,
//             visibility: 'visible',
//             duration: 1,
//             ease: 'power2.out',
//             immediateRender: false
//           }
//         );
//       });
//
//       // Пересчитываем при изменении размера окна
//       $(window).on('resize', function () {
//         ScrollTrigger.refresh(true);
//       });
//     }
//   });
// }
//
// // Запускаем инициализацию
// initCardsAnimation();

// // Проверяем, загружен ли уже GSAP и ScrollTrigger ==================================================
// function initCardsAnimation() {
//   if (typeof jQuery === 'undefined') {
//     console.error('jQuery не загружен');
//     return;
//   }
//
//   jQuery(document).ready(function ($) {
//     // Проверяем, загружен ли уже GSAP
//     if (typeof gsap === 'undefined') {
//       // Загружаем GSAP и ScrollTrigger
//       loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', function () {
//         loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', setupAnimation);
//       });
//     } else if (typeof gsap.ScrollTrigger === 'undefined') {
//       // Загружаем только ScrollTrigger, если GSAP уже загружен
//       loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', setupAnimation);
//     } else {
//       // И GSAP, и ScrollTrigger уже загружены
//       setupAnimation();
//     }
//
//     // Функция для загрузки скриптов
//     function loadScript(src, callback) {
//       const script = document.createElement('script');
//       script.src = src;
//       script.onload = callback;
//       document.head.appendChild(script);
//     }
//
//     // Настройка анимации с GSAP
//     function setupAnimation() {
//       // Регистрируем плагин ScrollTrigger
//       gsap.registerPlugin(ScrollTrigger);
//
//       const section = $('#cards-showcase');
//       const wrapper = $('.cards-wrapper');
//       const cards = $('.card-item');
//       const totalCards = cards.length;
//
//       if (totalCards === 0) return;
//
//       // Устанавливаем высоту секции в зависимости от количества карточек
//       // Увеличиваем общую высоту секции для более плавного скролла в конце
//       const sectionHeight = (totalCards * 60) + 150; // Увеличено для более длительного скролла в конце
//       section.css('height', sectionHeight + 'vh');
//
//       // Создаем фиксацию wrapper при скролле
//       ScrollTrigger.create({
//         trigger: section,
//         start: 'top top',
//         end: 'bottom bottom',
//         pin: wrapper,
//         pinSpacing: false
//       });
//
//       // Сначала скрываем все карточки и устанавливаем их в начальное положение
//       gsap.set(cards, {
//         opacity: 0,
//         visibility: 'hidden',
//         y: '100vh' // Начальное положение - за пределами экрана снизу
//       });
//
//       // Высота видимого смещения для стекирования карточек
//       const visibleHeaderHeight = 70; // в пикселях
//
//       // Проходимся по каждой карточке
//       cards.each(function (index) {
//         const card = $(this);
//
//         // Установка z-index для корректного наложения карточек
//         card.css('z-index', index + 1);
//
//         // Вычисляем смещение для каждой карточки
//         // const offsetY = (index * visibleHeaderHeight);
//         const offsetY = index === totalCards - 1 ? 0 : -(totalCards - 1 - index) * visibleHeaderHeight;
//         // Определяем точки начала и конца для анимации каждой карточки
//         // Уменьшаем начальный скролл и увеличиваем конечный
//         const startScroll = 0 + (index * 12); // Уменьшено начальное значение (было 20 + index * 20)
//         const endScroll = startScroll + 30; // Увеличиваем интервал для более длительной анимации в конце (было +20)
//
//         // Создаем timeline для анимации появления карточки
//         const cardTl = gsap.timeline({
//           scrollTrigger: {
//             trigger: section,
//             start: `top+=${startScroll}% top`, // Начало анимации
//             end: `top+=${endScroll}% top`, // Конец анимации
//             scrub: 1.5, // Увеличиваем плавность анимации
//             toggleActions: 'play none none reverse'
//           }
//         });
//
//         // Анимация появления карточки
//         cardTl.fromTo(card,
//           {
//             y: '100vh', // Начинаем с позиции за пределами экрана
//             opacity: 0,
//             visibility: 'hidden'
//           },
//           {
//             y: offsetY, // Конечная позиция с учетом смещения для эффекта стопки
//             opacity: 1,
//             visibility: 'visible',
//             duration: 2,
//             ease: 'power2.out',
//             immediateRender: false
//           }
//         );
//       });
//
//       // Пересчитываем при изменении размера окна
//       $(window).on('resize', function () {
//         ScrollTrigger.refresh(true);
//       });
//     }
//   });
// }
//
// // Запускаем инициализацию
// initCardsAnimation();

// Проверяем, загружен ли уже GSAP и ScrollTrigger================= Последний вариант ================================
// function initCardsAnimation() {
//   if (typeof jQuery === 'undefined') {
//     console.error('jQuery не загружен');
//     return;
//   }
//
//   jQuery(document).ready(function ($) {
//     // Проверяем, загружен ли уже GSAP
//     if (typeof gsap === 'undefined') {
//       // Загружаем GSAP и ScrollTrigger
//       loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', function () {
//         loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', setupAnimation);
//       });
//     } else if (typeof gsap.ScrollTrigger === 'undefined') {
//       // Загружаем только ScrollTrigger, если GSAP уже загружен
//       loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', setupAnimation);
//     } else {
//       // И GSAP, и ScrollTrigger уже загружены
//       setupAnimation();
//     }
//
//     // Функция для загрузки скриптов
//     function loadScript(src, callback) {
//       const script = document.createElement('script');
//       script.src = src;
//       script.onload = callback;
//       document.head.appendChild(script);
//     }
//
//     // Настройка анимации с GSAP
//     function setupAnimation() {
//       // Регистрируем плагин ScrollTrigger
//       gsap.registerPlugin(ScrollTrigger);
//
//       const section = $('#cards-showcase');
//       const wrapper = $('.cards-wrapper');
//       const cards = $('.card-item');
//       const totalCards = cards.length;
//
//       if (totalCards === 0) return;
//
//       // Устанавливаем высоту секции в зависимости от количества карточек
//       // Увеличиваем общую высоту секции для более плавного скролла в конце
//       const sectionHeight = (totalCards * 80) + 150; // Увеличено для более длительного скролла в конце
//       section.css('height', sectionHeight + 'vh');
//
//       // Создаем фиксацию wrapper при скролле
//       ScrollTrigger.create({
//         trigger: section,
//         start: 'top top',
//         end: 'bottom bottom',
//         pin: wrapper,
//         pinSpacing: false
//       });
//
//       // Сначала скрываем все карточки и устанавливаем их в начальное положение
//       gsap.set(cards, {
//         opacity: 0,
//         visibility: 'hidden',
//         y: '100vh' // Начальное положение - за пределами экрана снизу
//       });
//
//       // Высота видимого смещения для стекирования карточек
//       const visibleHeaderHeight = 70; // в пикселях
//
//       // Получаем высоту контейнера для точных расчетов
//       const containerHeight = wrapper.height();
//
//       // Устанавливаем абсолютное начальное положение карточек для точного контроля
//       cards.css({
//         'position': 'absolute',
//         'left': '0',
//         'right': '0',
//         'top': '0' // Начальная позиция от верха контейнера
//       });
//
//       // Проходимся по каждой карточке
//       // Важно: мы проходим по карточкам в обратном порядке, чтобы правильно настроить z-index
//       // Это обеспечит правильное наложение карточек друг на друга
//       $(cards.get().reverse()).each(function (reversedIndex) {
//         const card = $(this);
//         const index = totalCards - 1 - reversedIndex; // Восстанавливаем оригинальный индекс
//
//         // Устанавливаем z-index: первая карточка должна быть внизу стопки
//         card.css('z-index', index + 1);
//
//         // Финальная позиция карточки:
//         // - Первая карточка (index 0) в нижней части контейнера
//         // - Каждая последующая карточка смещается вверх, но останавливается не доходя до верха
//         // - Это создает эффект каскада, где видна часть предыдущей карточки
//         const finalPosition = index * visibleHeaderHeight;
//
//         // Определяем точки начала и конца для анимации каждой карточки
//         const startScroll = 10 + (index * 30); // Уменьшенное начальное значение
//         const endScroll = startScroll + 50; // Увеличенный интервал для плавной анимации
//
//         // Создаем анимацию для этой конкретной карточки
//         const tl = gsap.timeline({
//           scrollTrigger: {
//             trigger: section,
//             start: `top+=${startScroll}% top`, // Начало анимации
//             end: `top+=${endScroll}% top`, // Конец анимации
//             scrub: 1.5, // Плавная анимация при скролле
//             toggleActions: 'play none none reverse'
//           }
//         });
//
//         // Анимация появления карточки с точным позиционированием
//         tl.fromTo(card,
//           {
//             y: containerHeight, // Начинаем с позиции за нижним краем контейнера
//             opacity: 0,
//             visibility: 'hidden'
//           },
//           {
//             y: finalPosition, // Финальная позиция с учетом индекса
//             opacity: 1,
//             visibility: 'visible',
//             duration: 1,
//             ease: 'power2.out',
//             immediateRender: false
//           }
//         );
//
//         // Создаем timeline для анимации появления карточки
//         const cardTl = gsap.timeline({
//           scrollTrigger: {
//             trigger: section,
//             start: `top+=${startScroll}% top`, // Начало анимации
//             end: `top+=${endScroll}% top`, // Конец анимации
//             scrub: 1.5, // Увеличиваем плавность анимации
//             toggleActions: 'play none none reverse'
//           }
//         });
//
//         // Анимация появления карточки с точным позиционированием
//         cardTl.fromTo(card,
//           {
//             y: containerHeight, // Начинаем с позиции за нижним краем контейнера
//             opacity: 0,
//             visibility: 'hidden'
//           },
//           {
//             y: finalPosition, // Конечная позиция - 0 для последней карточки
//             opacity: 1,
//             visibility: 'visible',
//             duration: 1,
//             ease: 'power2.out',
//             immediateRender: false
//           }
//         );
//       });
//
//       // Добавляем отладочную информацию для проверки позиционирования
//       console.log('Container height:', containerHeight);
//       console.log('Total cards:', totalCards);
//
//       // Пересчитываем при изменении размера окна
//       $(window).on('resize', function () {
//         ScrollTrigger.refresh(true);
//       });
//     }
//   });
// }
//
// // Запускаем инициализацию
// initCardsAnimation();
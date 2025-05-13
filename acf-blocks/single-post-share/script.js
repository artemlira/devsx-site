(function () {
  // Код выполнится после загрузки DOM
  document.addEventListener('DOMContentLoaded', function () {
    const shareBlock = document.getElementById('<?php echo esc_js($unique_id); ?>');
    if (!shareBlock) return;

    // Находим все кнопки, которые копируют ссылку в буфер обмена
    const clipboardButtons = shareBlock.querySelectorAll('.share-clipboard');
    const notification = shareBlock.querySelector('.share-notification');

    // Добавляем обработчики для каждой кнопки
    clipboardButtons.forEach(function (button) {
      button.addEventListener('click', function (e) {
        e.preventDefault();

        // Получаем данные из атрибутов
        const url = button.getAttribute('data-url');
        const title = button.getAttribute('data-title');
        let networkName = button.querySelector('.screen-reader-text').textContent;

        // Копируем ссылку в буфер обмена
        navigator.clipboard.writeText(url).then(function () {
          // Показываем уведомление
          notification.textContent = `Link copied! Now you can share it on ${networkName}`;
          notification.style.display = 'block';

          // Скрываем уведомление через 3 секунды
          setTimeout(function () {
            notification.style.display = 'none';
          }, 3000);
        }).catch(function (err) {
          console.error('Failed to copy text: ', err);
        });
      });
    });
  });
})();
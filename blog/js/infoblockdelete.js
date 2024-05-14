document.querySelectorAll('.btn-close').forEach(button => {
    button.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      
      // Отправка AJAX запроса на сервер
      fetch('/delete_element.php', {
        method: 'POST',
        body: JSON.stringify({ id: id }),
        headers: {
          'Content-Type': 'application/json'
        }
      })
      .then(response => {
        if (response.ok) {
          // Обновление страницы или списка элементов
          location.reload();
        } else {
          console.error('Ошибка удаления элемента');
        }
      });
    });
  });
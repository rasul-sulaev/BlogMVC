/** Передача данных по форме **/
let form = document.querySelectorAll('.form');
let transitionForm = document.querySelectorAll('.transition-form');

form.forEach(f => {
  f.onsubmit = async (e) => {
    e.preventDefault();

    try {
      let response = await fetch(e.target.action, {
        method: e.target.method,
        body: new FormData(f)
      })

     let json = await response.json();

      if (json.url) {
        location.href = json.url;
      } else {
        alert(`${json.status} - ${json.message}`);
      }
    } catch (err) {
      console.log(err)
    }
  }
});


transitionForm.forEach(f => {
  f.onsubmit = async (e) => {
    e.preventDefault();

    try {
      let response = await fetch(e.target.action, {
        method: e.target.method,
        body: new FormData(f)
      })

     let json = await response.json();

      if (json.url) {
        location.href = json.url;
      } else {
        alert(`${json.status} - ${json.message}`);

        setTimeout(() => {
            location.href = json.transitionUrl;
        }, 1000)
      }
    } catch (err) {
      console.log(err)
    }
  }
})


/** Спрашивать перед переходом по ссылке **/
let getConfirm = document.querySelectorAll('.get-confirm');

getConfirm.forEach(a => {
  a.addEventListener('click', (e) => {
    let confirmContent = a.hasAttribute('data-confirm-content') ? a.getAttribute('data-confirm-content') : 'Перейти?';
    if (confirm(confirmContent) === false) {
      e.preventDefault();
    }
  })
})




/** CKEditor **/
if (document.querySelector( '#editor' )) {
  ClassicEditor
      .create( document.querySelector( '#editor' ), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'mediaEmbed', 'undo', 'redo', 'list' ],
        heading: {
          options: [
            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
          ]
        }
      } )
      .catch( error => {
        console.log( error );
      } );
}


/** Комментарии **/
let commentSuccess = document.querySelector('.comments .success');

if (commentSuccess) {
  setTimeout(() => {
    commentSuccess.classList.add('none');
  }, 6000);
}



const colis = document.getElementById('coli');

if (colis) {
 colis.addEventListener('click', e => {
    if (e.target.className === 'btn btn-outline-danger delete-colis') {
      if (confirm('vous êtes sûre?')) {
        const id = e.target.getAttribute('data-id');

        fetch(`/colis/delete/${id}`, {
          method: 'DELETE'
        }).then(res => window.location.reload());
      }
    }
  });
}
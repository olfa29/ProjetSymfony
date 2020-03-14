

const  trajet = document.getElementById('trajet');

if (trajet) {
 trajet.addEventListener('click', e => {
    if (e.target.className === 'btn btn-outline-danger delete-trajet') {
      if (confirm('vous êtes sûre?')) {
        const id = e.target.getAttribute('data-id');

        fetch(`/trajet/delete/${id}`, {
          method: 'DELETE'
        }).then(res => window.location.reload());
      }
    }
  });
}
const livresMehodes = {      
  
  open(position) {
    position = position;
    dialog = true;
  },
  setLivres() {
    axios
      .post("http://localhost/Bexpress/BScript/livres.php", {
        code: 1,
      })
      .then((r) => {
        livres = r.data;
        // alert(r.data)
      })
      .catch((res) => {
        alert("serveur non disponible");
      });
    
    console.log('merde')
  },
  addVue(livre, newVues) {
    axios
      .post("http://localhost/Bexpress/BScript/livres.php", {
        code: 2,
        vues: newVues,
        livre: livre.id,
      })
      .then((r) => {
        livre.vues = parseInt(livre.vues) + 1;
        // alert(r.data)
      })
      .catch((res) => {
        alert("serveur non disponible");
      });
  },
  addFav(livre, newfavs) {
    axios
      .post("http://localhost/Bexpress/BScript/livres.php", {
        code: 3,
        favs: newfavs,
        livre: livre.id,
      })
      .then((r) => {
        livre.inFav = true;
        livre.fav = parseInt(livre.fav) + 1;
        // alert(r.data)
      })
      .catch((res) => {
        alert("serveur non disponible");
      });
  },
  callLogIn() {
    $router.push("/");
  },
  getInterval() {
    axios
      .post("http://localhost/Bexpress/BScript/livres.php", {
        code: 4,
      })
      .then((r) => {
        annee = r.data;
        if (annee.length > 0) {
          selectedAnnee = annee[0].value;
        }
        // alert(r.data)
      })
      .catch((res) => {
        alert("serveur non disponible");
      });
  },
  searchLivre() {
    axios
      .post("http://localhost/Bexpress/BScript/livres.php", {
        code: 5,
        title: "",
        first_year: selectedAnnee.first_year,
        second_year: selectedAnnee.second_year,
      })
      .then((r) => {
        livres = r.data;
        // alert(r.data)
      })
      .catch((res) => {
        alert("serveur non disponible");
      });
  },
};

export default livresMehodes;

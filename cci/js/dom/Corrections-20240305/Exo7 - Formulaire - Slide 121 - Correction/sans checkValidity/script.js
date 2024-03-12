  // Range les conditions dans un objets
  const storage = {
      lastName: {
        condition : " inputs[i].value.length > 2", 
        isValidated : false
      },
      firstName: {
        condition : " inputs[i].value.length > 2", 
        isValidated : false
      },
      age: {
        condition : " inputs[i].value >= 5 && inputs[i].value <= 140", 
        isValidated : false
      },
      login: {
        condition : "inputs[i].value.length >= 4", 
        isValidated : false
      },
      pwd1: {
        condition : " inputs[i].value.length >= 6", 
        isValidated : false
      },
      pwd2: {
        condition : " inputs[i].value == inputs[i-1].value",
        isValidated : false
      }
  };

   // Récupère tous les inputs
  let inputs = document.querySelectorAll('input[type=text], input[type=password]');

  // Récupère les tooltips et les masquent
  let tooltips = document.querySelectorAll('.tooltip');
  tooltips.forEach(element => element.style.display = 'none' );


  let _storage;
  for (let i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('input', function() {
        // Pour pouvoir utiliser l'index de l'objet conditions j'utilise la methode values de la class Object
        _storage = Object.values(storage)[i];
        console.log(_storage.condition);
        // Comme mes conditions sont stoquées en tant que string dans un objet, j'utilise la méthode eval qui me permet d'en faire une vraie condition et pas une string (attention => faille de sécurité)
        if (eval(_storage.condition)) {
          inputs[i].className = "correct";
          inputs[i].nextElementSibling.style.display = 'none';
          _storage.isValidated = true;
        } else {
          inputs[i].className = "incorrect";
          inputs[i].nextElementSibling.style.display = 'inline-block';
          _storage.isValidated = false;
        }
    })
}


  document.querySelector('#myForm').addEventListener('submit', function (e) {
      // Par défaut je valide le form
      let isFormValid = true;
      // Je scanne l'objet conditions et cherche si une propriété isValidated est fausse
      for (inputName in storage) {
        if (!storage[inputName].isValidated) isFormValid=false;
      }
      // Si c'est tout bon, je
      if (isFormValid) {
        alert('Merci pour votre interet. Votre demande sera traitée dans les plus brefs délais.');
      } else {
        e.preventDefault();
        alert('Tous les champs ne sont pas correctement remplis');
      }

      const formData = new FormData(this);
      console.log(formData);

  });


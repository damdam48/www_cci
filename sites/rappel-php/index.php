<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title id="titletag"> </title>

</head>
<body>

    <?php
        $user['cat']=2;
        $user['cgu']=0;

        $cat[1] = 'A';
        $cat[2] = 'B';
        $cat[3] = 'C';
        $cat[4] = 'D';

    ?>

    <select>
        <?php 
            foreach ($cat as $key => $value) { ?>
                <option value="" <?php if ($key == $user['cat']) {echo 'selected';} ?> >
                    <?php echo $value; ?>
                </option>
        <?php } ?>

    </select>

    <hr>


        <select name="" id="">
            <?php foreach ($cat as $key => $value) {
                echo '<option value="" '.$key. ' "';
                    if ($key == $user['cat']) {echo 'selected';}
                echo '>' .$value. '</option>';
            } ?>

        </select>

    <hr>




    <?php 
        foreach ($cat as $key => $value) { ?>
            <label for="radio">
                <input type="radio" name="radio" value="radio" CHECKED> 
            </label>
            <?php echo $value; ?>
        <?php } ?>
    
    <hr>


        <?php foreach ($cat as $key => $value) {
            echo '<label for="radio">';
                echo '<input type="radio" name="radio" value="radio" ';
                if ($key == $user['cat']) {echo 'CHECKED';}
                echo '>'. $value;
            echo '</label>';
            
            
        }?>

    <hr>

    <input type="checkbox" name="" id="" <?php if($user['cgu']) {echo 'CHECKED';}?> >
    <?php
        if ($user['cgu']) {
            echo 'les CGU ont été acceptées';
        }
        else {
            echo 'les CGU n\'ont pas été acceptées';
        }
        ?>
    <hr>






        <input class="onglet" id="titleinput" onkeyup="titlechange()" type="text" name="" id="" placeholder="Tape le nom de l'onglet" >
        <br>



        <label id="cgulabel" onmouseup="cguTEST()">
            <input id="cgucheckbox" type="checkbox" name="checkbox" <?php if($user['cgu']) {echo 'checked';}?> >
        
                <span id='cgutext'>
                <?php
                    echo $user['cgu'] == 1 ? 'les CGU ont été acceptées' : 'les CGU n\'ont pas été acceptées';
                    ?>
                </span>
        </label>

        <div>
            <input id="submitbtn" type="submit" <?php echo $user['cgu']==0? 'disabled' :''; ?> >
        </div>   




    <script type="text/javascript" >
        function cguTEST() {
            // afficher element en entier
            // alert('dédé')

            // console.log('cguTEST')
        

            element = document.querySelector('#cgucheckbox')
            // console.log(Element)

            console.log(element.checked)

            mylabel = document.querySelector('#cgulabel')
            cgutext = document.querySelector('#cgutext')
            submitbtn = document.querySelector('#submitbtn')

            if ( element.checked != true) {
                mylabel.style.color = '#000'
                mylabel.style.backgroundColor = '#fff'
                cgutext.innerHTML = 'les CGU ont été acceptées'
                submitbtn.disabled = false
            } else {
                mylabel.style.color = '#f00'
                mylabel.style.backgroundColor = '#0f0'
                cgutext.innerHTML = 'les CGU n\'ont pas été acceptées'
                submitbtn.disabled = true
            }
        }

    function titlechange() {
        text = document.querySelector('#titleinput').value
        title = document.querySelector('#titletag')
        title.innerHTML = text
    }
    </script>


    <hr>

        
</body>
</html>
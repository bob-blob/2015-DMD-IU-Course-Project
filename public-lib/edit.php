    
    <?php
    
    $paperid = $_GET['pid'];
    $typo = $_GET['kind'];
    
    
    echo '<div>
 
    <h1 style="font-family: sans; color: #002E3D; text-align: center;">Edit publication</h1>
    <form class="navbar-form navbar-left" role="search" method="post" action="index.php?page=editDB&pid='.$paperid.'" id="searchform">
        <div class="search">
            <div class="field"><h2>Publication</h2>
                <div class="row">  <label> Please, enter publication title first! </label>
                    <div class="rightField"><input type="text" name="title" class="form-control" placeholder="Publication title" size="30"></div></div></br>
                <div class="row"> <label>Enter type of publication</label>
                    <div class="rightField"><input type="text" name="type" class="form-control" placeholder="Type of paper" size="30"></div></div></br>
                <div class="row"> <label>Add new keywords divided by spacebar: </label>
                    <div class="rightField"><input type="text" name="keyword" class="form-control" placeholder="Keywords" size="30"></div></div></br>
                <div class="row"><label>Include a link to publication: </label>
                    <div class="rightField"><input type="text" name="link" class="form-control" placeholder="Link" size="30"></div></div></br>
                <div class="row">  <label>Write down year when publication was published: </label>
                    <div class="rightField"><input type="text" name="year" class="form-control" placeholder="Year" size="30"></div></div></br>
            </div>

            <div class="field">  <h2>Authors</h2>
                <div class="row">  <label>Add authors divided by ampersand(&): </label>
                    <div class="rightField"><input type="text" name="name" class="form-control" placeholder="Author name" size="30"></div></div></br>

                <div class="row">  <label>Add workplace of authors divided by ampersand(&): </label>
                    <div class="rightField"><input type="text" name="workplace" class="form-control" placeholder="Workplaces" size="30"></div></div></br>
            </div>
            
            
            <p class="explain">The main thing to do is to choose where publication was published, whether it was presented at Conference, or it was printed in some Journal. Of course, it can be both of them. Choose correctly!</p>
            ';
 if($typo==0) {echo ' 
            <div class="field"> <h2>Conference</h2>
                <div class="row"><label>Add Venue name of the Conference: </label>
                    <div class="rightField"><input type="text" name="venue" class="form-control" placeholder="Venue" size="30"></div></div></br>
            </div>';
 }else{ echo ' 
            <div class="field"> <h2>Journal</h2>
                <div class="row"><label>Include journal name: </label>
                    <div class="rightField"><input type="text" name="journalName" class="form-control" placeholder="Journal name" size="30"></div></div></br>

                <div class="row"><label>Enter volume of Journal item: </label>
                    <div class="rightField"><input type="text" name="volume" class="form-control" placeholder="Volume" size="30"></div></div></br>

                <div class="row"><label>Add number of the journal: </label>
                    <div class="rightField"><input type="text" name="number" class="form-control" placeholder="Number" size="30"></div></div></br>

                <div class="row"><label>Add pages of journal where publication placed: </label>
                    <div class="rightField"><input type="text" name="pages" class="form-control" placeholder="Pages" size="30"></div></div></br>
 </div>';}
echo ' 
            <div style="margin: auto; text-align: center;"><button type="submit" name="confSearch" class="btn btn-primary btn-lg">Edit publication</button></div>
        </div>
    </form></div>';
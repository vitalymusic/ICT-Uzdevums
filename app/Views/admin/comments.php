
    <?php include("header.php")?>
    <?php include("menu.php")?>
<div class="container">
    <h1><?=$title?></h1>
    <?php //var_dump($comments)?>
    <table class="table">
        <tr>
            <td>Lietotājs</td>
            <td>Komentārs</td>
            <td>laiks un datums</td>
            <td>Darbības</td>
        </tr>

        <?php foreach($comments as $key=>$value):?>
            
        <tr>
            <td><?=$value["comment_user"]?></td>
            <td><?=$value["comment_content"]?></td>
            <td><?=$value["comment_time"]?></td>
            <td>
                <button class="btn btn-danger delBtn" data-id="<?=$value["comments_id"]?>" data-action="delete">Dzēst komentāru</button>

                </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>



    
<!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>



    <script>
        $(document).ready(function(){

            $(".delBtn").click(function(event){
            if(confirm("Vai jūs tiešām vēlaties izdzēst?")){
                id = $(event.target).data("id");
                console.log(id);
                $.get("<?=base_url()?>/admin/deleteComments/"+id,function(resp){
                    if(resp=="success"){
                    location.href="<?=base_url()?>/admin/comments"
                }
                })
            }
            
            
        })
        })
    </script>
</body>
</html>

    <?php include("header.php")?>
    <?php include("menu.php")?>
<div class="container">
    <h1><?=$title?></h1>
    <?php //var_dump($category_table)?>
    <table class="table">
        <tr>
            <td>Lietotājs</td>
            <td>Lietotājvārds</td>
            <td>E-pasts</td>
            <td>Darbības</td>
        </tr>
        <?php foreach($users as $value):?>

        <tr>
            <td><?=$value["users_name"]?> <?=$value["users_surname"]?></td>
            <td><?=$value["username"]?></td>
            <td><?=$value["email"]?></td>
            <td>
                <button class="btn btn-primary editBtn" data-id="<?=$value["users_id"]?>" data-action="edit">Rediģēt</button>
                <button class="btn btn-danger delBtn" data-id="<?=$value["users_id"]?>" data-action="delete">Dzēst</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div class="container">
        <button class="btn btn-primary" id="createNew">Izveidot jaunu</button>
    </div>
</div>

<!-- Lietotāja izveide -->

<div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Jauna kategorija</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="users_form">
            <div class="mb-3">
                <label for="category_name" class="form-label">Vārds</label>
                <input type="text" class="form-control" id="users_name" name="users_name">
            </div>
            <div class="mb-3">
                <label for="cat_seo_name" class="form-label">Uzvārds</label>
                <input type="text" class="form-control" id="users_surname" name="users_surname">
            </div>
            <div class="mb-3">
                <label for="cat_seo_name" class="form-label">Lietotajvārds</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="cat_seo_name" class="form-label">Parole</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="cat_seo_name" class="form-label">Parole atkārtot</label>
                <input type="password" class="form-control" id="password_repeat" name="password_repeat">
            </div>
            <div class="mb-3">
                <label for="cat_seo_name" class="form-label">Epasta adrese</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveUser">Saglabāt</button>
        <button type="button" class="btn btn-primary" id="updateUser" hidden>Saglabāt izmaiņas</button>
      </div>
    </div>
  </div>
</div>

<!-- Lietotāja izveide -->


    
<!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){

        //Jaunu lietotāju saglabāšanas poga
            $("#createNew").click(function(){
                $("#modal3 .modal-title").text("Izveidot jaunu lietotāju");
                $("#modal3 #saveUser").attr("hidden",false);
                $("#modal3 #updateUser").attr('hidden',true);
                $("#modal3").modal('show');
            })

        $("#saveUser").click(function(){
            data = $("#users_form").serialize();
            $.post("<?=base_url()?>/admin/saveUser",data,function(resp){
                if(resp=="success"){
                    location.href="<?=base_url()?>/admin/users"
                }
            });
        })
        // updateButton = "";
        $(".editBtn").click(function(event){
            id = $(event.target).data("id");
            $.get("<?=base_url()?>/admin/getUser/"+id,function(resp){
                console.log(resp[0]);
                $("#modal3 .modal-title").text("Rediģēt");
                $("#modal3 #saveUser").attr("hidden",true);
                $("#modal3 #updateUser").attr('hidden',false);
                
                $("#modal3 input[name='users_name']").val(resp[0].users_name);
                $("#modal3 input[name='users_surname']").val(resp[0].users_surname);
                $("#modal3 input[name='username']").val(resp[0].username);
                $("#modal3 input[name='password']").val(resp[0].password);
                $("#modal3 input[name='password_repeat']").val(resp[0].password);
                $("#modal3 input[name='email']").val(resp[0].email);
                $("#modal3 #users_form").prepend(`
                <input type="hidden" name="users_id" value="${resp[0].users_id}">
                `);
                $("#modal3").modal('show');

                
            });
            
        })
        $("#updateUser").click(function(event){
            //alert();
            data = $("#users_form").serialize();
            currId = $("input[name='users_id']").val();
            $.post("<?=base_url()?>/admin/updateUser/"+currId,data,function(resp){
                 if(resp=="success"){
                     location.href="<?=base_url()?>/admin/users"
                 }
            });

        })

        $(".delBtn").click(function(event){
            if(confirm("Vai jūs tiešām vēlaties izdzēst?")){
                id = $(event.target).data("id");
                console.log(id);
                $.get("<?=base_url()?>/admin/deleteUser/"+id,function(resp){
                    if(resp=="success"){
                    location.href="<?=base_url()?>/admin/users"
                }
                })
            }
            
            
        })
    })


    </script>
</body>
</html>
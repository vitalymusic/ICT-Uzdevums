
    <?php include("header.php")?>
    <?php include("menu.php")?>
<div class="container">
    <h1>Kategorijas</h1>
    <?php //var_dump($category_table)?>
    <table class="table">
        <tr>
            <td>Nosaukums</td>
            <td>Apraksts</td>
            <td>Darbības</td>
        </tr>
        <?php foreach($category_table as $key=>$value):?>

        <tr>
            <td><?=$value["cat_name"]?></td>
            <td><?=$value["content"]?></td>
            <td>
                <button class="btn btn-primary editBtn" data-id="<?=$value["id"]?>" data-action="edit">Rediģēt</button>
                <button class="btn btn-danger delBtn" data-id="<?=$value["id"]?>" data-action="delete">Dzēst</button>

                </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div class="container">
        <button class="btn btn-primary" id="createNew">Izveidot jaunu</button>
    </div>
</div>

<!-- Kategoriju izveide -->

<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Jauna kategorija</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="category_form">
            <div class="mb-3">
                <label for="category_name" class="form-label">Kategorijas nosaukums</label>
                <input type="text" class="form-control" id="category_name" name="category_name">
            </div>
            <div class="mb-3">
                <label for="cat_seo_name" class="form-label">SEO</label>
                <input type="text" class="form-control" id="cat_seo_name" name="cat_seo_name">
            </div><div class="mb-3">
                <label for="content" class="form-label">Kategorijas apraksts</label>
                <textarea type="text" class="form-control" id="content" name="content"></textarea>
            </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveCategory">Saglabāt</button>
        <button type="button" class="btn btn-primary" id="updateCategory" hidden>Saglabāt izmaiņas</button>
      </div>
    </div>
  </div>
</div>

<!-- Kategoriju izveide -->








    
<!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function(){
            

        


        //Jaunu kategoriju saglabāšanas poga
            $("#createNew").click(function(){
                $("#modal1 .modal-title").text("Izveidot jaunu");
                $("#modal1 #saveCategory").attr("hidden",false);
                $("#modal1 #updateCategory").attr('hidden',true);
                $("#modal1").modal('show');
            })

        $("#saveCategory").click(function(){
            data = $("#category_form").serialize();
            $.post("<?=base_url()?>/admin/saveCategory",data,function(resp){
                if(resp=="success"){
                    location.href="<?=base_url()?>/admin/categories"
                }
            });
        })
        // updateButton = "";
        $(".editBtn").click(function(event){
            id = $(event.target).data("id");
            $.get("<?=base_url()?>/admin/getcategory/"+id,function(resp){

                $("#modal1 .modal-title").text("Rediģēt");
                $("#modal1 #saveCategory").attr("hidden",true);
                $("#modal1 #updateCategory").attr('hidden',false);
                
                $("#modal1 input[name='category_name']").val(resp[0].cat_name);
                $("#modal1 input[name='cat_seo_name']").val(resp[0].cat_seo_name);
                $("#modal1 textarea[name='content']").val(resp[0].content);
                $("#modal1 #category_form").prepend(`
                <input type="hidden" name="cat_id" value="${resp[0].id}">
                `);
                $("#modal1").modal('show');

                
            });
            
        })
        $("#updateCategory").click(function(event){
            //alert();
            data = $("#category_form").serialize();
            currId = $("input[name='cat_id']").val();
            $.post("<?=base_url()?>/admin/updateCategory/"+currId,data,function(resp){
                 if(resp=="success"){
                     location.href="<?=base_url()?>/admin/categories"
                 }
            });

        })

        $(".delBtn").click(function(event){
            if(confirm("Vai jūs tiešām vēlaties izdzēst?")){
                id = $(event.target).data("id");
                console.log(id);
                $.get("<?=base_url()?>/admin/deleteCategory/"+id,function(resp){
                    if(resp=="success"){
                    location.href="<?=base_url()?>/admin/categories"
                }
                })
            }
            
            
        })
    })


    </script>
</body>
</html>
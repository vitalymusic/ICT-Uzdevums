<?php include("header.php")?>
<?php include("menu.php")?>
<div class="container">
    <h1>Ziņas</h1>
    <?php //var_dump($news_table)?>
    <table class="table">
        <tr>
            <td>Ziņas nosaukums</td>
            <td>Saturs</td>
            <td>Kategorija</td>
            <td>Darbības</td>
        </tr>
        <?php foreach($news_table as $key=>$value):?>

        <tr>
            <td><?=$value["news_name"]?></td>
            <td><?=$value["news_content"]?></td>
            <td><?=$value["cat_name"]?></td>
            <td>
                <button class="btn btn-primary editBtn" data-id="<?=$value["news_id"]?>" data-action="edit">Rediģēt</button>
                <button class="btn btn-danger delBtn" data-id="<?=$value["news_id"]?>" data-action="delete">Dzēst</button>

            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div class="container">
        <button class="btn btn-primary" id="createNews">Izveidot jaunu</button>
    </div>
</div>
<!-- Ziņu izveide -->

<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Jauna ziņa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="news_form">
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Ziņas nosaukums</label>
                        <input type="text" class="form-control" id="news_name" name="news_name">
                    </div>
                    <div class="mb-3">
                        <label for="cat_seo_name" class="form-label">Ziņas kategorija</label>
                        <select name="news_category_id" id="news_category_id" class="form-select">
                            <option value="">test</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Ziņas saturs</label>
                        <textarea type="text" class="form-control" id="news_content" name="news_content"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveNews">Saglabāt</button>
                <button type="button" class="btn btn-primary" id="updateNews" hidden>Saglabāt izmaiņas</button>
            </div>
        </div>
    </div>
</div>

<!-- Ziņu izveide -->



<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function () {
       


        $('#modal2').on('shown.bs.modal', function (e) {
            $("#news_category_id").empty();
            
            $.get("<?=base_url()?>/admin/categoryList",function(data){
                for(x in data){
                    console.log(data[x]);
                    $("#news_category_id").append(`
                        <option value="${data[x].id}">${data[x].cat_name}</option>
                    `)
                }
                
            })
        })

        //Jaunu kategoriju saglabāšanas poga
        $("#createNews").click(function () {
            
            $("#modal2 .modal-title").text("Izveidot jaunu");
            $("#modal2 #saveNews").attr("hidden", false);
            $("#modal2 #updateNews").attr('hidden', true);
            $("#modal2").modal('show');

            
        })

        $("#saveNews").click(function () {
            data = $("#news_form").serialize();
            $.post("<?=base_url()?>/admin/saveNews", data, function (resp) {
                if (resp == "success") {
                    location.href = "<?=base_url()?>/admin/news"
                }
            });
        })
        // updateButton = "";
        $(".editBtn").click(function (event) {

            id = $(event.target).data("id");
            //console.log(id);
            $.get("<?=base_url()?>/admin/getNewsById/" + id, function (resp) {
                console.log(resp)
                $("#modal2 .modal-title").text("Rediģēt");
                $("#modal2 #saveNews").attr("hidden", true);
                $("#modal2 #updateNews").attr('hidden', false);

                $("#modal2 input[name='news_name']").val(resp[0].news_name);
                $("#modal2 input[name='news_category_id']").val(resp[0].category_id);

                $("#modal2 textarea[name='news_content']").val(resp[0].news_content);
                $("#modal2 #news_form").prepend(`
                <input type="hidden" name="news_id" value="${resp[0].news_id}">
                `);
                $("#modal2").modal('show');


            });

        })
        $("#updateNews").click(function (event) {
            //alert();
            data = $("#news_form").serialize();
            currId = $("input[name='news_id']").val();
            $.post("<?=base_url()?>/admin/updateNews/" + currId, data, function (resp) {
                if (resp == "success") {
                    location.href = "<?=base_url()?>/admin/news"
                }
            });

        })

        $(".delBtn").click(function (event) {
            if (confirm("Vai jūs tiešām vēlaties izdzēst?")) {
                id = $(event.target).data("id");
                console.log(id);
                $.get("<?=base_url()?>/admin/deleteNews/" + id, function (resp) {
                    if (resp == "success") {
                        location.href = "<?=base_url()?>/admin/news"
                    }
                })
            }


        })

    })
</script>
</body>

</html>
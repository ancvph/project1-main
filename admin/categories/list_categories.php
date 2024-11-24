<div class="container">
    <h1>Trang Danh sách Danh mục</h1>
    <a href="./index.php?act=add_categories"><button type="button" class="btn btn-primary m-2">Thêm danh
            mục</button></a>


    <table class="table table-striped" border="2">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Danh mục</th>
                <th scope="col">Chuyển hướng</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($list_categories as $category){
                extract($category);
                $update = "index.php?act=fix_categories&category_id=".$category_id;
                $delete = "./index.php?act=delete_categories&category_id=".$category_id;
                echo '<tr>
                        <th scope="row">'.$category_id.'</th>
                        <td>'.$category_name.'</td>
                        
                        <td>
                            <a href="'.$update.'"><button type="button" class="btn btn-danger">Sửa</button></a>
                            <a href="'.$delete.'"><button type="button" class="btn btn-warning">Xoá</button></a>
                        </td>
                    </tr>';
            }
        ?>


        </tbody>
    </table>
</div>
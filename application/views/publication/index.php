<h3>Publications</h3>
<div id="publication-list">
<?php
    $username = $this->session->userdata('username');
    echo '<div class="add-button">';
        echo anchor('publication/add_publication','Add Publication');
    echo '</div>';    
    $query = $this->publication_model->get_publication($username);

    echo '<div id="publication">';
    if ($query->num_rows()>0){
        $year = 0;
        $type = '';
        foreach ($query->result() as $row)
        {
            if ($year!=$row->year)
            {
                $year=$row->year;
                $type = '';
                echo '<p class="year">';
                echo $year;
                echo '</p>';
            }
            if ($type!== $row->type)
            {
                $type = $row->type;
                echo '<p class="type">';
                echo $type;
                echo '</p>';
            }
            echo '<p>';
            if ($row->content)
                echo $row->content;
            else
                echo $row->title;
            echo '</p>';
        }
    }else{
        echo '<h3> No Record Found!</h3>';
    }
    echo '</div>';
?>
</div>

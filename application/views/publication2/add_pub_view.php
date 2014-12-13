<?php
    echo form_open('publication/submit');
?>
<h3>Department Publications</h3>
<div class='form'>
    <p>
    <label for='author'> Author</label>
    <?php
        $query=$this->publication_model->get_author();
        foreach ($query->result() as $row)
        {
            $option[$row->uniqueid]=$row->faculty_name;
        }
        
        echo form_dropdown('author',$option);
    ?>
    </p>
    <p>
    <label for='year'> Year(4 digits)</label>
     <?php
        $option=array();
        $year = date("Y");
        for ($i=0;$i <=10; $i++)
        {
            $option[$year] = $year;
            $year--;       
        }
        echo form_dropdown('year',$option);
    ?>
    </p>
    
    <p>
    <label for='type'>Type</label>
    <?php
        $query = $this->publication_model->get_publication_type();
        $option=array();
        foreach($query->result() as $row)
        {
            $option[$row->publication_type]=$row->publication_type;
        }      
       
        $attr='size="3"';
        echo form_dropdown('type',$option,'conference',$attr);
    ?>
    </p>
    <p>
    <label for='status'> Status </label>
    <?php
        $option=array(
            'published' =>  'published',
            'accepted'  => 'accepted',
            'submitted' =>  'submitted',
            'in progress' =>  'in progress',            
            'working paper' =>  'working paper',
        );       
       
        echo form_dropdown('status',$option);
    ?>       
    </p>
    <p>
    <label for='title'> Title </label>
    <?php
        $data=array(
            "name" => 'title',
            "size" => 90,
            "maxlength" =>200
        );
        echo form_input($data);
    ?>
    </p>
    <!--
        data entry needed
    -->
    <p>
    <label for='Coauthor'> Coauthors </label>
    <?php
         $data=array(
            "name" => 'coauthor',
            "size" => 50,
            "maxlength" =>100
        );
        echo form_input($data);
    ?>
    </p>
    <p>
    <label for='cofaculty_count'> # Faculty Coauthors </label>
    <?php
        $option=array(
            0 => '0',
            1 => '1',
            2 => '2',
            3 => '3'
        );
        $attr='size="3"';
        echo form_dropdown('cofaculty',$option,'0');
    ?>
    </p>
    <p>
    <label for='costudent'> # Student Coauthors </label>
    undergraduate
    <?php
        $option=array(
            0 => '0',
            1 => '1',
            2 => '2',
            3 => '3'
        );
        $attr='size="3"';
        echo form_dropdown('costudent_u',$option,'0');
    ?>
    graduate
    <?php
        $option=array(
            0 => '0',
            1 => '1',
            2 => '2',
            3 => '3'
        );
        $attr='size="3"';
        echo form_dropdown('costudent_g',$option,'0');
    ?>
    </p>
    <p>
    <label for="content">Citation Information</label>
    <div class="textarea">
        <?php
            $data = array(
              'name'        => 'content',
              'rows'        => '3',
              'cols'        => '70'
            );
            echo form_textarea($data);
        ?>
    </div>
    </p>
    <p>
    <label for="comment">Comment(optional)</label>
    <div class="textarea">
        <?php
            $data = array(
              'name'        => 'comment',
              'rows'        => '3',
              'cols'        => '70'
            );
            echo form_textarea($data);
        ?>
    </div>
    </p>
    <p>
        <?php
            echo form_submit('submit','Submit');
        ?>
    </p>
</div>
</form>
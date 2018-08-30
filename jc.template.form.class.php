<?php

class JCTemplateForm extends JCTemplate {

    var $results = null;

    function TemplateForm($results = null){

        if($results)
            $this->results = $results;
        else
            $this->results = new stdclass;
    }
   
    function startForm($title, $method = 'get', $action = ''){

        $this->startHTML(); ?>

            <div class="container">
            <h3><?=$title?></h3>
            <form class="form-horizontal" method="<?=$method?>" action="<?=$action?>">
            <fieldset>
        <?php $this->endHTML();
    }

    function endForm(){

        $this->startHTML(); ?>

        </fieldset>
        </form>

        </div>

        <?php $this->endHTML();
    }
    
    function select($fieldname, $label, $options, $value = ''){

        $selected = $value ? $value : $this->getResult($fieldname);
        $this->startHTML();?>
            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="<?=$fieldname?>"><?=$label?></label>
                <div class="col-md-4">
                    <select id="<?=$fieldname?>" name="<?=$fieldname?>" class="form-control">
                    <option value=""> - Select - </option>
                    <?php foreach($options as $value => $option): ?>
                        <option value="<?=$value?>" <?=$value == $selected ? 'selected':''?>  ><?=$option?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
        <?php $this->endHTML();
    }

    function text($fieldname, $label, $placeholder = '', $value = ''){

        $value = $value ? $value : $this->getResult($fieldname);;
        $this->startHTML(); ?>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-4 control-label" for="<?=$fieldname?>"><?=$label?></label>  
            <div class="col-md-4">
            <input id="<?=$fieldname?>" name="<?=$fieldname?>" type="text" placeholder="<?=$placeholder?>" class="form-control input-md" value="<?=$value?>">
                
            </div>
            </div>
        
        <?php $this->endHTML();

    }

    function radio($fieldname, $label, $options, $value = ''){

        $checked = $value ? $value : $this->getResult($fieldname);
        $this->startHTML(); ?>
            <!-- Multiple Radios -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="radios"><?$label?></label>
                <div class="col-md-4">
                    <?php foreach($options as $option): is_object($option) ? $option = $option->label : $option; ?>
                        <div class="radio">
                            <label for="radios-0">
                                <input type="radio" name="<?=$fieldname?>" id="<?=$fieldname?>-0" value="<?=$option?>" <?=$option==$checked? 'checked="checked"':''?>>
                                <?=$option?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php $this->endHTML();
    }

    function hidden($fieldname, $value = ''){

        $value = $value ? $value : $this->getResult($fieldname);;
        $this->startHTML(); ?>

            <input type="hidden" name="<?=$fieldname?>" value="<?=$value?>">
        
        <?php $this->endHTML();

    }

    function submit($fieldname, $value){

        $value = $value ? $value : $this->getResult($fieldname);;
        $this->startHTML(); ?>

            <input type="submit" name="<?=$fieldname?>" value="<?=$value?>" class="btn btn-primary">
        
        <?php $this->endHTML();

    }

    function getResult($fieldname){

        return isset($this->results->{$fieldname}) ? $this->results->{$fieldname} : '';
    }

    function button($id, $label, $href){

        $this->startHTML(); ?>

            <div class="form-group">
                <label class="col-md-4 control-label" for="radios"></label>
                <div class="col-md-4">
                    <a href="<?=$href?>" id="<?=$id?>" class="btn btn-primary"><?=$label?></a>
                </div>
            </div>

        <?php $this->endHTML();
    }
}
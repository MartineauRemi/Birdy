<?php
    namespace BirdyFram;

    class StringField extends Field{
        protected $maxLength;

        public function buildWidget(){
            $widget = '';

            if(!empty($this->errorMsg))
                $widget .= $this->errorMsg . '<br/>';

            $widget .= '<label>' . $this->label . '</label><input type="text" name="' . $this->name . '"';

            if(!empty($this->value))
                $widget .= ' value="'. htmlspecialchars($this->value) . '"';

            if(!empty($this->maxlength))
                $widget .= ' maxlength="' . $this->maxLength . '"';

            $widget .= '/>';
        }

        public function setMaxLength($maxLength){
            $maxLength = (int)$maxLength;

            if($maxLength > 0)
                $this->maxLength = $maxLength;
            else
                throw new \RuntimeException('The maximum length must be more than 0.');
        }
    }
?>
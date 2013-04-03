<?php

class ButtonFilter extends CWidget
{
	public $items=array();

	public $itemCssClass;
        
        public $filterGroupName;
        
        public $fkField;
        
        /**
         *
         * @var type bool
         * if true, add an inline-block to the li tag, makes the list inline
         */
        public $inline;
        
        public $blockStyle;
        
        /**
         * 2 types of selection:
         * multi: multislection
         * radio: radio button like selection
         */
        public $selectionType;

	public function init()
	{
            
	}

	/**
	 * Calls {@link renderMenu} to render the menu.
	 */
	public function run()
	{
                $this->addBlockStyle();
		$this->renderMenu($this->items);
	}

	/**
	 * Renders the menu items.
	 * @param array $items menu items. Each menu item will be an array with at least two elements: 'label' and 'active'.
	 * It may have three other optional elements: 'items', 'linkOptions' and 'itemOptions'.
	 */
	protected function renderMenu($items)
	{
		if(count($items))
		{
                    echo "<ul id=$this->filterGroupName".
                                " selectionType=$this->selectionType".
                                " class=selectionGroup".
                                " fkField=$this->fkField".
                                ">";
                    foreach ($items as $item)
                    {
                        echo "<li class=".$this->itemCssClass." filterGroupName=".$item['filterGroupName']." itemId=".$item['itemId'].
                                " style=display:". $this->blockStyle.">".$item['label']."</li>";
                        
                    }
                    
                    echo "</ul>";
		}
	}
        
        protected function addBlockStyle()
        {
            if (!$this->inline)
            {
                $this->blockStyle = "block";
            }
            else 
            {
                $this->blockStyle = "inline-block";
            }
        }
        
}
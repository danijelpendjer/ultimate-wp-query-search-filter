<?php
if(!class_exists('uwpqsfront')){
  class uwpqsfront{
  
  function output_formtaxo_fields($type,$exc,$hide,$taxname,$taxlabel,$taxall,$opt,$c,$defaultclass,$formid,$divclass){
		$eid = explode(",", $exc);
		$args = array('hide_empty'=>$hide,'exclude'=>$eid );	
		$taxoargs = apply_filters('uwpqsf_taxonomy_arg',$args,$formid);
        	$terms = get_terms($taxname,$taxoargs);
 	    $count = count($terms);
		 if($type == 'dropdown'){
			$html  = '<div class="'.$defaultclass.' '.$divclass.' tax-select-'.$c.'"><span class="taxolabel-'.$c.'">'.$taxlabel.'</span>';
			$html .= '<input  type="hidden" name="taxo['.$c.'][name]" value="'.$taxname.'">';
			$html .= '<input  type="hidden" name="taxo['.$c.'][opt]" value="'.$opt.'">';
			$html .=  '<select id="tdp-'.$c.'" name="taxo['.$c.'][term]">'; 
			if(!empty($taxall)){
				$html .= '<option selected value="uwpqsftaxoall">'.$taxall.'</option>';
			}
					if ( $count > 0 ){
						foreach ( $terms as $term ) {							
					$html .= '<option value="'.$term->slug.'">'.$term->name.'</option>';}
			}				
			$html .= '</select>';
			$html .= '</div>';
			return  apply_filters( 'uwpqsf_tax_field_dropdown', $html ,$type,$exc,$hide,$taxname,$taxlabel,$taxall,$opt,$c,$defaultclass,$formid,$divclass);
		}
		if($type == 'checkbox'){
 			if ( $count > 0 ){
				$html  = '<div class="'.$defaultclass.' '.$divclass.' tax-check-'.$c.' togglecheck"><span  class="taxolabel-'.$c.'">'.$taxlabel.'</span >';
				$html .= '<input  type="hidden" name="taxo['.$c.'][name]" value="'.$taxname.'">';
				$html .= '<input  type="hidden" name="taxo['.$c.'][opt]" value="'.$opt.'">';
				if(!empty($taxall)){
				$html .= '<label><input type="checkbox" id="tchkb-'.$c.'" name="taxo['.$c.'][call]" class="chktaxoall" >'.$taxall.'</label>';
				}
				foreach ( $terms as $term ) {
				$value = $term->slug;
				$html .= '<label><input type="checkbox" id="tchkb-'.$c.'" name="taxo['.$c.'][term][]" value="'.$value.'" >'.$term->name.'</label>';
				}
				$html .= '</div>';
				return  apply_filters( 'uwpqsf_tax_field_checkbox', $html ,$type,$exc,$hide,$taxname,$taxlabel,$taxall,$opt,$c,$defaultclass,$formid,$divclass);
			}
 			
		}
		if($type == 'radio'){
 			if ( $count > 0 ){
				$html  = '<div class="'.$defaultclass.' '.$divclass.' tax-radio-'.$c.'"><span class="taxolabel-'.$c.'">'.$taxlabel.'</span>';
				$html .= '<input  type="hidden" name="taxo['.$c.'][name]" value="'.$taxname.'">';
				$html .= '<input  type="hidden" name="taxo['.$c.'][opt]" value="'.$opt.'">';
				if(!empty($taxall)){
				$html .= '<label><input type="radio" id="tradio-'.$c.'" name="taxo['.$c.'][term]" value="uwpqsftaxoall">'.$taxall.'</label>';
				}
			foreach ( $terms as $term ) {
				$html .= '<label><input type="radio" id="tradio-'.$c.'" name="taxo['.$c.'][term]" value="'.$term->slug.'">'.$term->name.'</label>';
			}

				
				$html .= '</div>';
				return  apply_filters( 'uwpqsf_tax_field_radio', $html ,$type,$exc,$hide,$taxname,$taxlabel,$taxall,$opt,$c,$defaultclass,$formid,$divclass);
			}
 			
		}
		 if($type != 'dropdown' or $type != 'checkbox' or $type != 'radio') {
			return apply_filters( 'uwpqsf_addtax_field_'.$type.'', $type,$exc,$hide,$taxname,$taxlabel,$taxall,$opt,$c,$defaultclass,$formid,$divclass);
	
		}
		
		
	 }

   function output_formcmf_fields($type,$metakey,$compare,$metaval,$label,$all,$i,$defaultclass,$id,$divclass ){
		 $opts = explode("|", $metaval);
		
		 if($type == 'dropdown'){
				$html = '<div class="'.$defaultclass.' '.$divclass.' cmf-select'.$i.'"><span class="cmflabel-'.$i.'">'.$label.'</span>';
				$html .= '<input type="hidden" name="cmf['.$i.'][metakey]" value="'.$metakey.'">';
				$html .= '<input type="hidden" name="cmf['.$i.'][compare]" value="'.$compare.'">';
				$html .=  '<select id="cmfdp-'.$i.'" name="cmf['.$i.'][value]">'; 
				if(!empty($all)){
				$html .= '<option value="uwpqsfcmfall">'.$all.'</option>';
				}
				
					foreach ( $opts as $opt ) {
							 $val = explode('::',$opt);
							$html .= '<option value="'.$val[0].'">'.$val[1].'</option>';
					}
				$html .= '</select>';
				$html .= '</div>';
				
				return  apply_filters( 'uwpqsf_cmf_field_dropdown', $html,$type,$metakey,$compare,$metaval,$label,$all,$i,$defaultclass,$id,$divclass);
			
			}
		 if($type == 'checkbox'){
			     $html  = '<div class="'.$defaultclass.' '.$divclass.' cmf-check-'.$i.' togglecheck"><span class="cmflabel-'.$i.'">'.$label.'</span>';
				 $html .= '<input type="hidden" name="cmf['.$i.'][metakey]" value="'.$metakey.'">';
				 $html .= '<input type="hidden" name="cmf['.$i.'][compare]" value="'.$compare.'">';
				if(!empty($all)){
				 $html .= '<label><input type="checkbox" id="cmf-'.$i.'" name="cmf['.$i.'][call]" class="chkcmfall" >'.$all.'</label>';
				}				
				foreach ( $opts as $opt ) {
						 $val = explode('::',$opt);
				$html .= '<label><input type="checkbox" id="cmf-'.$i.'" name="cmf['.$i.'][value][]" value="'.$val[0].'" >'.$val[1].'</label>';	
					}
			 	$html .= '</div>';
				
				return  apply_filters( 'uwpqsf_cmf_field_checkbox', $html,$type,$metakey,$compare,$metaval,$label,$all,$i,$defaultclass,$id,$divclass);
		 }	
		 if($type == 'radio'){
			    $html  = '<div class="'.$defaultclass.' '.$divclass.' cmf-radio-'.$i.'"><span class="cmflabel-'.$i.'">'.$label.'</span>';
				$html .= '<input type="hidden" name="cmf['.$i.'][metakey]" value="'.$metakey.'">';
				$html .= '<input type="hidden" name="cmf['.$i.'][compare]" value="'.$compare.'">';
			if(!empty($all)){
        	   		 $html .= '<label><input type="radio" id="cmf-'.$i.'" name="cmf['.$i.'][value]" value="uwpqsfcmfall">'.$all.'</label>';
			}
		
			foreach ( $opts as $opt ) {
				 $val = explode('::',$opt);
				$html .= '<label><input type="radio" id="cmf-'.$i.'" name="cmf['.$i.'][value]" value="'.$val[0].'" >'.$val[1].'</label>';	
			} 
				$html .= '</div>';
				
				return  apply_filters( 'uwpqsf_cmf_field_radio', $html,$type,$metakey,$compare,$metaval,$label,$all,$i,$defaultclass,$id,$divclass);
		 }
		if($type != 'dropdown' or $type != 'checkbox' or $type != 'radio') {
			return apply_filters( 'uwpqsf_addcmf_field_'.$type.'', $type,$metakey,$compare,$metaval,$label,$all,$i,$defaultclass,$id,$divclass);
	
		}  	
		 
	  }	
	
  }//end class
}//end check class
;?>

<?php

/**
 * Class Types_Field_Type_Video_View_Frontend
 *
 * Handles view specific tasks for field "Video"
 *
 * @since 2.3
 */
class Types_Field_Type_Video_View_Frontend extends Types_Field_Type_View_Frontend_Abstract {
	/**
	 * Types_Field_Type_Single_Line_View_Frontend constructor.
	 *
	 * @param Types_Field_Type_Video $entity
	 * @param array $params
	 */
	public function __construct( Types_Field_Type_Video $entity, $params = array() ) {
		$this->entity = $entity;
		$this->params = $params;
	}

	/**
	 * @return string
	 */
	public function get_value() {
		if ( ! $this->is_raw_output() ) {
			$this->add_decorator( new Types_View_Decorator_Video() );
		}

		$rendered_value = array();
		foreach( (array) $this->entity->get_value_filtered( $this->params ) as $value ) {
			$rendered_value[] = $this->filter_field_value_after_decorators(
				$this->get_decorated_value( $value ),
				$value
			);
		}

		$value = $this->to_string( $rendered_value );

		return $this->maybe_show_field_name( $value );
	}
}

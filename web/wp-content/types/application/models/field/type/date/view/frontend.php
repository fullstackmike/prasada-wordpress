<?php

/**
 * Class Types_Field_Type_Date_View_Frontend
 *
 * Handles view specific tasks for field "Single Line"
 *
 * @since 2.3
 */
class Types_Field_Type_Date_View_Frontend extends Types_Field_Type_View_Frontend_Abstract {
	/**
	 * Types_Field_Type_Date_View_Frontend constructor.
	 *
	 * @param Types_Field_Type_Date $entity
	 * @param array $params
	 */
	public function __construct( Types_Field_Type_Date $entity, $params = array() ) {
		$this->entity = $entity;
		$this->params = $params;
	}

	/**
	 * @return string
	 */
	public function get_value() {
		if( ! $this->is_raw_output() && isset( $this->params['style'] ) && $this->params['style'] ) {
			$this->add_decorator( new Types_View_Decorator_Calendar() );
		}

		$rendered_value = array();
		foreach( (array) $this->entity->get_value_filtered( $this->params ) as $value ) {
			if( empty( $value ) ) {
				continue;
			}

			$rendered_value[] = $this->filter_field_value_after_decorators(
				$this->get_decorated_value( $value ),
				$value
			);
		}
		$value = $this->to_string( $rendered_value );

		return $this->maybe_show_field_name( $value );
	}
}

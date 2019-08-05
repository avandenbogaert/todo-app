import React from 'react';
import Form from "react-bootstrap/Form";

class ItemForm extends React.Component {
    constructor(props) {
        super(props);
        this.onSubmit = this.onSubmit.bind(this);
    }

    componentDidMount() {
        this.refs.itemName.focus();
    }

    onSubmit(event) {
        event.preventDefault();
        this.props.addItem(this.refs.itemName.value);
        this.refs.form.reset();
    }

    render() {
        return (
            <div className="todo-item-form-wrapper">
                <Form className="todo-item-form" onSubmit={this.onSubmit} ref="form">
                    <Form.Row>
                        <Form.Group controlId="formGridEmail">
                            <Form.Control type="text" placeholder="Something todo.." ref="itemName" required />
                        </Form.Group>

                        <Form.Group controlId="formGridPassword">
                            <Form.Control type="submit" value="Add" className="btn btn-info" />
                        </Form.Group>
                    </Form.Row>
                </Form>
            </div>
        );
    }
}

export default ItemForm;
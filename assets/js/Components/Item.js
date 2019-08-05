import React from 'react';
import ListGroupItem from "react-bootstrap/ListGroupItem";
import {FaCheck, FaTrash, FaUndo} from "react-icons/fa";

class Item extends React.Component {
    constructor(props) {
        super(props);

        this.onDelete = this.onDelete.bind(this);
        this.onCheck = this.onCheck.bind(this);
    }

    onDelete() {
        this.props.onDelete(this.props.uuid)
    }

    onCheck() {
        this.props.onCheck(this.props.uuid, !this.props.checked);
    }

    render() {
        return (
            <ListGroupItem className={"todo-item"} variant={this.props.checked ? 'light' : ''}>
                {this.props.content}

                <div className={"btn btn-danger delete"} onClick={this.onDelete}>
                    <FaTrash/>
                </div>

                <div onClick={this.onCheck} className={"btn btn-" + (this.props.checked ? 'secondary' : 'primary')}>
                    {!this.props.checked &&
                        <FaCheck/>
                    }

                    {this.props.checked &&
                        <FaUndo/>
                    }
                </div>
            </ListGroupItem>
        );
    }
}

export default Item
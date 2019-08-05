import React from 'react';
import ListGroup from "react-bootstrap/ListGroup";
import Alert from "react-bootstrap/Alert";
import Item from "./Item";
import Spinner from "react-bootstrap/Spinner";

class ItemList extends React.Component {

    render() {

        if (this.props.fetching) {
            return (
                <div className="loader">
                    <Spinner animation="grow"/>
                </div>
            );
        }

        const items = this.props.items;

        return (
            <React.Fragment>
                <ListGroup as="ul" className="todo-list">
                    {items.map((item, index) => {
                        return (
                            <Item key={index}
                                  uuid={item.uuid}
                                  content={item.content}
                                  checked={item.checked}
                                  onCheck={this.props.onCheck}
                                  onDelete={this.props.onDelete}
                            />
                        );
                    })}
                </ListGroup>

                {(items.filter(item => item.checked).length === items.length && items.length > 0) &&
                <Alert variant="info">
                    All items checked, you're doing great !
                </Alert>
                }

            </React.Fragment>
        );
    }
}

export default ItemList;
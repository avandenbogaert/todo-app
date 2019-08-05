import React from 'react';
import ListGroup from "react-bootstrap/ListGroup";
import TodoItem from "./TodoItem";
import Alert from "react-bootstrap/Alert";
import Spinner from "react-bootstrap/Spinner";
import ItemForm from "./ItemForm";

class ItemList extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            items: [],
            fetching: true
        };

        this.fetchItems = this.fetchItems.bind(this);
        this.addItem = this.addItem.bind(this);
        this.checkItem = this.checkItem.bind(this);
        this.deleteItem = this.deleteItem.bind(this);
    }

    componentDidMount() {
        this.fetchItems();
    }

    fetchItems() {
        fetch('/list')
            .then(response => response.json())
            .then(data => this.setState({items: data}))
            .then(() => {this.setState({fetching: false})})
    }

    addItem(value) {
        fetch('/create', {
            method: 'POST',
            body: JSON.stringify({content: value})
        }).then(this.fetchItems);
    }

    checkItem(uuid, value) {
        if (value) {
            fetch('/' + uuid + '/check', {method: 'POST'}).then(this.fetchItems)
        } else {
            fetch('/' + uuid + '/uncheck', {method: 'POST'}).then(this.fetchItems)
        }
    }

    deleteItem(uuid) {
        fetch('/' + uuid + '/delete'.replace('%id%', uuid), {method: 'POST'}).then(this.fetchItems)
    }

    render() {
        const items = this.state.items;

        if (this.state.fetching) {
            return (
                <div className="loader">
                    <Spinner animation="grow"/>
                </div>
            );
        }

        return (
            <React.Fragment>
                <ItemForm addItem={this.addItem}/>

                <ListGroup as="ul" className="todo-list">
                    {this.state.items.map((item, index) => {
                        return (
                            <TodoItem key={index}
                                      uuid={item.uuid}
                                      content={item.content}
                                      checked={item.checked}
                                      onCheck={this.checkItem}
                                      onDelete={this.deleteItem}
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
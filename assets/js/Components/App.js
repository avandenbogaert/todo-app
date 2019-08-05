import React from 'react';
import Container from "react-bootstrap/Container";
import ItemList from "./ItemList";
import ItemInput from "./ItemInput";

class App extends React.Component {

    constructor() {
        super();

        this.fetchItems = this.fetchItems.bind(this);
        this.addItem = this.addItem.bind(this);
        this.checkItem = this.checkItem.bind(this);
        this.deleteItem = this.deleteItem.bind(this);

        this.state = {
            items: [],
            fetching: true
        };
    }

    componentDidMount() {
        this.fetchItems();
    }

    fetchItems() {
        fetch('/items')
            .then(response => response.json())
            .then(data => this.setState({items: data}))
            .then(() => {
                this.setState({fetching: false});
            });
    }

    addItem(value) {
        fetch('/item/create', {method: 'POST', body: JSON.stringify({content: value})})
            .then(response => response.json())
            .then((item) => {
                this.setState({items: [...this.state.items, item]});
            });
    }

    checkItem(uuid, value) {
        fetch('/item/' + uuid + '/' + (value ? 'check' : 'uncheck'), {method: 'PATCH'})
            .then(response => response.json())
            .then((item) => {
                this.setState({
                    items: this.state.items.map((existing => {
                        return item.uuid === existing.uuid ? item : existing
                    }))
                });
            });
    }

    deleteItem(uuid) {
        fetch('/item/' + uuid + '/delete'.replace('%id%', uuid), {method: 'DELETE'})
            .then(response => response.json())
            .then(() => {
                this.setState({
                    items: this.state.items.filter((item) => {
                        return item.uuid !== uuid
                    })
                });
            });
    }

    render() {
        return (
            <div className="App">
                <Container>
                    <h1>Some things I need to do</h1>
                    <ItemInput onSubmit={this.addItem}/>
                    <ItemList fetching={this.state.fetching}
                              items={this.state.items}
                              onDelete={this.deleteItem}
                              onCheck={this.checkItem}
                    />
                </Container>
            </div>
        );
    }
}

export default App;






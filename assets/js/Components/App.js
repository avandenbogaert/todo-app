import React from 'react';
import Container from "react-bootstrap/Container";
import ItemList from "./ItemList";

class App extends React.Component {
    render() {
        return (
            <div className="App">
                <Container>
                    <h1>Some things I need to do</h1>
                    <ItemList />
                </Container>
            </div>
        );
    }
}

export default App;






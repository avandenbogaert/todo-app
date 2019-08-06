import React from 'react';
import ReactDOM from 'react-dom';
import ItemList from "../../assets/js/Components/ItemList";

it('renders without crashing', () => {
    const div = document.createElement('div');

    const items = [
        {
            uuid: "some-uuid-string",
            content: "some-content",
            checked: false
        }
    ];

    ReactDOM.render(<ItemList items={items}/>, div);
    ReactDOM.unmountComponentAtNode(div);
});
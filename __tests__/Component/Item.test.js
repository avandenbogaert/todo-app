import React from 'react';
import ReactDOM from 'react-dom';
import Item from "../../assets/js/Components/Item";

it('renders without crashing', () => {
    const div = document.createElement('div');
    ReactDOM.render(<Item uuid="some-uuid-string" content="some-content" checked={false} />, div);
    ReactDOM.unmountComponentAtNode(div);
});
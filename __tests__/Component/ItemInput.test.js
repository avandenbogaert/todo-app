import React from 'react';
import ReactDOM from 'react-dom';
import ItemInput from "../../assets/js/Components/ItemInput";

it('renders without crashing', () => {
    const div = document.createElement('div');
    ReactDOM.render(<ItemInput/>, div);
    ReactDOM.unmountComponentAtNode(div);
});
import React from 'react';
import ReactDOM from 'react-dom';
import Tabs from '@mui/material/Tabs';

function Overview() {


    return (
        <React.Fragment>
        <Box sx={{ borderBottom: 1, borderColor: 'divider' }}>
        <Tabs value={value} onChange={handleChange} aria-label="basic tabs example">
        <Tab label="Item One" {...a11yProps(0)} />
        <Tab label="Item Two" {...a11yProps(1)} />
         <Tab label="Item Three" {...a11yProps(2)} />
         </Tabs>
    </Box>
        <TabPanel value={value} index={0}>
        Item One
        </TabPanel>
        <TabPanel value={value} index={1}>
        Item Two
        </TabPanel>
        <TabPanel value={value} index={2}>
        Item Three
        </TabPanel>
        </React.Fragment>
    );
}

export default Overview;

if (document.getElementById('overview')) {
    ReactDOM.render(<Overview />, document.getElementById('overview'));
}

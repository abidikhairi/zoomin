import React, { useState } from 'react';
import axios from "axios";
import {Button, Form, Modal} from "react-bootstrap";
import Loader from "../Loader";

const MagistrateAssignForm = (props) => {
    const { claim, reloadClaimFunc } = props
    const [magistrate, setMagistrate] = useState('')
    const [magistrates, setMagistrates] = useState([])
    const {show, hideModal} = props
    axios.get('/api/magistrate/room/'+ claim.governorate.room.id)
        .then(response => {
            setMagistrates(response.data.magistrates)
        }).catch(err => {
            alert(err)
        })

    const handleClick = (e) => {
        e.preventDefault()
        axios.post('/api/room-president/claim/assign', {
            claim_id: claim.id,
            magistrate_id: parseInt(magistrate)
        }).then(response => {
            alert(response.data.message)
        }).catch(err => {
            alert(err)
        })
        reloadClaimFunc(e)
    }

    const onChangeMagistrate = (e) => {
        e.preventDefault()
        setMagistrate(e.target.value)
    }

    if(magistrates === []) {
        return <Loader kind={'border'} color={'primary'} styles={{width: '20rem', height: '20rem'}} />
    }

    return (<Modal show={show} onHide={hideModal} className={'modal-shortcut modal-slide'}>
            <Modal.Header closeButton>
                <Modal.Title>Magistrates</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <Form.Control type={'hidden'} value={claim.id} />
                <Form.Group controlId="Magistrate.Control">
                    <Form.Label>Magistrate</Form.Label>
                    <Form.Control as="select" onChange={onChangeMagistrate.bind(this)}>
                        {magistrates.map(magistrate => <option key={magistrate.id} value={magistrate.id}>{magistrate.user.email}</option>)}
                    </Form.Control>
                </Form.Group>
            </Modal.Body>
            <Modal.Footer>
                <Button variant="secondary" onClick={hideModal}>
                    Close
                </Button>
                <Button variant="primary" onClick={handleClick}>
                    Save Changes
                </Button>
            </Modal.Footer>
        </Modal>
    )
}

export default MagistrateAssignForm;

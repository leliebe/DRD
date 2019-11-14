<?xml version="1.0" encoding="UTF-8"?>
<sch:schema xmlns:sch="http://purl.oclc.org/dsdl/schematron" queryBinding="xslt2"
    xmlns:sqf="http://www.schematron-quickfix.com/validator/process">
    <sch:ns uri="http://www.tei-c.org/ns/1.0" prefix="tei"/> <!--Declares TEI namespace -->
    <sch:pattern>
        <sch:rule context="tei:teiHeader//tei:p"><!-- // means descendent, anywhere in the document-->
            
            
        </sch:rule>
        
        <sch:rule context="tei:body//tei:speaker/@xml:id">
            <sch:let name="IndexDoc" value="doc('raw.githubusercontent.com/DRD/DRD_Index.xml)"/>
            <sch:let name="roleIDs" value="$IndexDoc//tei:listRole/tei:role/@xml:id"/>
            <sch:let name="roleRefValues" value="for $i in $roleIDs return concat('#', $i)"/>
            <sch:assert test=". = $roleRefValues">
                Acceptable values: <sch:value-of select="string-join($roleRefValues, ', ')"/>
            </sch:assert>
        </sch:rule>
        
    </sch:pattern>
    
</sch:schema>
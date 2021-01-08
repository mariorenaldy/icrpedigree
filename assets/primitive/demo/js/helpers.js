/**
 * @preserve Basic Primitives Diagram v3.7.1
 * Copyright (c) 2013 - 2017 Basic Primitives Inc
 *
 * Non-commercial - Free
 * http://creativecommons.org/licenses/by-nc/3.0/
 *
 * Commercial and government licenses:
 * http://www.basicprimitives.com/pdf/license.pdf
 *
 */

/* File: Basic Primitives (primitives.latest.js)*/
(function () {

	var namespace = function (name) {
		var namespaces = name.split('.'),
			namespace = window,
			index;
		for (index = 0; index < namespaces.length; index += 1) {
			namespace = namespace[namespaces[index]] = namespace[namespaces[index]] || {};
		}
		return namespace;
	};

	namespace("helpers.controls");
}());

/* Configs */

helpers.controls.ControlType = {
	Caption: 0,
	RadioBox: 1,
	CheckBox: 2,
	DropDownBox: 3
};

helpers.controls.CaptionConfig = function (caption, isBig, id) {
	this.controlType = helpers.controls.ControlType.Caption;
	this.caption = caption;
	this.isBig = isBig;
	this.id = id;
};

helpers.controls.RadioBoxConfig = function (id, defaultItem, caption, items, valueType, onUpdate) {
	this.controlType = helpers.controls.ControlType.RadioBox;
	this.id = id;
	this.defaultItem = defaultItem;
	this.caption = caption;
	this.items = items;
	this.valueType = valueType;
	this.onUpdate = onUpdate;
};

helpers.controls.DropDownBoxConfig = function (id, defaultItem, caption, items, valueType, onUpdate) {
	this.controlType = helpers.controls.ControlType.DropDownBox;
	this.id = id;
	this.defaultItem = defaultItem;
	this.caption = caption;
	this.items = items;
	this.valueType = valueType;
	this.onUpdate = onUpdate;
};

/* Renders */

helpers.controls.CaptionRender = function () {
	this.render = function (config, namespace) {
		var tagName = config.isBig ? "h3" : "p";
		var controlBody = jQuery("<" + tagName + (config.id !== "" ? " id='" + namespace + config.id + "' " : "") + ">" + config.caption + "</" + tagName + ">");
		return controlBody;
	};
};

helpers.controls.RadioBoxRender = function () {

	this.render = function (config, namespace, defaultItem) {
		var controlBody = jQuery("<p id=" + namespace + config.id + " title=" + config.id + ">" + config.caption + "</p>");
		for (var key in config.items) {
			var value = config.items[key];
			controlBody.append(jQuery("<br/><label><input name='" + namespace + config.id + "' type='radio' value='" + value + "' " + (value == defaultItem ? "checked" : "") + " />" + primitives.common.splitCamelCaseName(key).join(" ") + "</label>"));
		}

		controlBody.change(function () {
			config.onUpdate(controlBody, config);
		});

		return controlBody;
	};

	this.getValue = function (item, namespace, formatters) {
		var formatter = formatters[item.valueType],
			result = formatter(jQuery("input:radio[name=" + namespace + item.id + "]:checked").val());
		return result;
	};
};

helpers.controls.DropDownBoxRender = function () {

	this.render = function (config, namespace, defaultItem) {
		var controlBody = jQuery("<p id=" + namespace + config.id + " title=" + config.id + ">" + config.caption + ": &nbsp;</p>");
		var controlList = jQuery("<select></select>");
		var key, value;
		controlBody.append(controlList);
		if (primitives.common.isArray(config.items)) {
			var hasItem = false;
			if (defaultItem == null) {
				controlList.append(jQuery("<option value='-1' selected>NULL</option>"));
				hasItem = true;
			}
			for (var index = 0, len = config.items.length; index < len; index += 1) {
				value = config.items[index];
				controlList.append(jQuery("<option value='" + (value == "NULL" ? -1 : value) + "' " + (value == defaultItem ? "selected" : "") + " >" + value + "</option>"));
				if (value == defaultItem) {
					hasItem = true;
				}
			}

			if (!hasItem) {
				controlList.append(jQuery("<option value='" + defaultItem + "' selected>" + defaultItem + "</option>"));
			}
		} else {
			if (defaultItem == null) {
				controlList.append(jQuery("<option value='-1' selected>NULL</option>"));
			}
			for (key in config.items) {
				if (config.items.hasOwnProperty(key)) {
					value = config.items[key];
					controlList.append(jQuery("<option value='" + (value == "NULL" ? -1 : value) + "' " + (value == defaultItem ? "selected" : "") + " >" + primitives.common.splitCamelCaseName(key).join(" ") + "</option>"));
				}
			}
		}

		controlBody.change(function () {
			config.onUpdate(controlBody, config);
		});

		return controlBody;
	};

	this.getValue = function (item, namespace, formatters) {
		var formatter = formatters[item.valueType],
			result = formatter(jQuery("#" + namespace + item.id + " option:selected").val());

		if (result == -1) {
			result = null;
		}
		return result;
	};
};

/* Formatters */

helpers.controls.ValueType = {
	Integer: 0,
	String: 1,
	Number: 2,
	Boolean: 3,
	Size: 4,
	Thickness: 5
};

helpers.controls.IntegerFormatter = function (value) {
	return parseInt(value, 10);
};

helpers.controls.StringFormatter = function (value) {
	return value.toString();
};

helpers.controls.NumberFormatter = function (value) {
	return parseFloat(value, 10);
};

helpers.controls.BooleanFormatter = function (value) {
	var stringValue = value.toString().toLowerCase();
	return stringValue == "true" || stringValue == "1";
};

helpers.controls.SizeFormatter = function (value) {
	value = parseFloat(value, 10);
	return new primitives.common.Size(value, value);
};

helpers.controls.ThicknessFormatter = function (value) {
	value = parseFloat(value, 10);
	return new primitives.common.Thickness(value, value, value, value);
};

/* Render */

helpers.controls.PanelConfig = function (caption, items, namespace) {
	this.caption = caption;
	this.items = items;
	this.namespace = namespace;
};

helpers.controls.Render = function (panels, defaultValues) {
	this.renders = {};
	this.renders[helpers.controls.ControlType.Caption] = new helpers.controls.CaptionRender();
	this.renders[helpers.controls.ControlType.RadioBox] = new helpers.controls.RadioBoxRender();
	this.renders[helpers.controls.ControlType.DropDownBox] = new helpers.controls.DropDownBoxRender();

	this.formatters = {};
	this.formatters[helpers.controls.ValueType.Integer] = helpers.controls.IntegerFormatter;
	this.formatters[helpers.controls.ValueType.String] = helpers.controls.StringFormatter;
	this.formatters[helpers.controls.ValueType.Number] = helpers.controls.NumberFormatter;
	this.formatters[helpers.controls.ValueType.Boolean] = helpers.controls.BooleanFormatter;
	this.formatters[helpers.controls.ValueType.Size] = helpers.controls.SizeFormatter;
	this.formatters[helpers.controls.ValueType.Thickness] = helpers.controls.ThicknessFormatter;

	this.panels = panels;
	this.defaultValues = defaultValues;

	this.render = function (placeholder) {
		var accordion = jQuery('<div></div>');
		placeholder.append(accordion);

		for (var panelIndex = 0, panelLen = this.panels.length; panelIndex < panelLen; panelIndex += 1) {
			var panelConfig = this.panels[panelIndex];

			accordion.append(jQuery('<h3>' + panelConfig.caption + '</h3>'));
			var content = jQuery('<div></div>');
			accordion.append(content);
			for (var index = 0; index < panelConfig.items.length; index += 1) {
				var item = panelConfig.items[index];
				var render = this.renders[item.controlType];
				var defaulValue = primitives.common.isNullOrEmpty(panelConfig.namespace) ? this.defaultValues[item.id] : this.defaultValues[panelConfig.namespace][item.id];

				content.append(render.render(item, panelConfig.namespace, defaulValue));
			}
		}
		accordion.accordion({
			active: 0,
			animate: 30,
			heightStyle: "content"
		});
	};

	this.getValues = function () {
		var result = {};
		for (var panelIndex = 0, panelLen = this.panels.length; panelIndex < panelLen; panelIndex += 1) {
			var panelConfig = this.panels[panelIndex];

			var panelOptions = result;
			if (!primitives.common.isNullOrEmpty(panelConfig.namespace)) {
				if (!result.hasOwnProperty(panelConfig.namespace)) {
					result[panelConfig.namespace] = {};
				}
				panelOptions = result[panelConfig.namespace];
			}

			for (var index = 0; index < panelConfig.items.length; index += 1) {
				var item = panelConfig.items[index];
				var render = this.renders[item.controlType];

				if (render.getValue != null) {
					panelOptions[item.id] = render.getValue(item, panelConfig.namespace, this.formatters);
				}
			}
		}
		return result;
	};
};

/* Demo Specific Functions */

helpers.controls.getOrgDiagramOptionsRender = function (defaultOptions, onUpdate) {
	var commonOptionsPanels = helpers.controls.getCommonOptionsPanels(onUpdate);
	return new helpers.controls.Render(commonOptionsPanels, defaultOptions);
};

helpers.controls.getFamDiagramOptionsRender = function (extraPanels, defaultOptions, onUpdate) {
	var panels = extraPanels;
	panels = panels.concat(helpers.controls.getFamDiagramOptionsPanels(onUpdate));
	panels = panels.concat(helpers.controls.getAnnotationsOptionsPanels(onUpdate));
	panels = panels.concat(helpers.controls.getCommonOptionsPanels(onUpdate));

	return new helpers.controls.Render(panels, defaultOptions);
};

helpers.controls.getFamDiagramOptionsPanels = function (onUpdate) {
	return [
			new helpers.controls.PanelConfig("Family Diagram Specific Options", [
				new helpers.controls.RadioBoxConfig("neighboursSelectionMode", primitives.common.NeighboursSelectionMode.ParentsChildrenSiblingsAndSpouses, "Neighbours Selection Modes", primitives.common.NeighboursSelectionMode, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.RadioBoxConfig("groupByType", primitives.common.GroupByType.Children, "Group by option defines node placement in layout close to its parents or children when node is linked across multiple levels in hierarchy. See \"alignment\" data set.", { Children: 2, Parents: 1 }, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.DropDownBoxConfig("alignBylevels", "true", "This option keeps items at the same levels after connections bundling", ["true", "false"], helpers.controls.ValueType.Boolean, onUpdate)
			])
	];
};

helpers.controls.getAnnotationsOptionsPanels = function (onUpdate) {
	return [
			new helpers.controls.PanelConfig("On-screen Annotations Specific Options", [
				new helpers.controls.RadioBoxConfig("connectorPlacementType", primitives.common.ConnectorPlacementType.Offbeat, "Placement type", primitives.common.ConnectorPlacementType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.RadioBoxConfig("connectorShapeType", primitives.common.ConnectorShapeType.OneWay, "Connector shape type", primitives.common.ConnectorShapeType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.RadioBoxConfig("labelPlacementType", primitives.common.ConnectorLabelPlacementType.Between, "Label Placement type", primitives.common.ConnectorLabelPlacementType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.DropDownBoxConfig("lineWidth", 1, "Line width", [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], helpers.controls.ValueType.Number, onUpdate),
				new helpers.controls.RadioBoxConfig("lineType", primitives.common.LineType.Dashed, "Line type", primitives.common.LineType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.DropDownBoxConfig("color", primitives.common.Colors.Red, "Color", primitives.common.Colors, helpers.controls.ValueType.String, onUpdate),
				new helpers.controls.DropDownBoxConfig("offset", 5, "Offset", [-50, -20, -10, -5, 0, 5, 10, 20, 50], helpers.controls.ValueType.Number, onUpdate),
				new helpers.controls.RadioBoxConfig("zOrderType", primitives.common.ZOrderType.Auto, "Connector Z order type", primitives.common.ZOrderType, helpers.controls.ValueType.Integer, onUpdate)
			], "AnnotationOptions")
	];
};

helpers.controls.getCommonOptionsPanels = function (onUpdate) {
	return [new helpers.controls.PanelConfig("Auto Layout Options", [
				new helpers.controls.CaptionConfig("Page Fit Mode defines rule of fitting chart into available screen space. Set it to None if you want to disable it.", false),
				new helpers.controls.RadioBoxConfig("pageFitMode", primitives.common.PageFitMode.FitToPage, "Page Fit Mode", { None: 0, PageWidth: 1, PageHeight: 2, FitToPage: 3, SelectionOnly: 6 }, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.RadioBoxConfig("orientationType", primitives.common.OrientationType.Top, "Orientation Type", primitives.common.OrientationType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.RadioBoxConfig("verticalAlignment", primitives.common.VerticalAlignmentType.Middle, "Items Vertical Alignment", primitives.common.VerticalAlignmentType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.RadioBoxConfig("horizontalAlignment", primitives.common.HorizontalAlignmentType.Center, "Items Horizontal Alignment", primitives.common.HorizontalAlignmentType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.RadioBoxConfig("childrenPlacementType", primitives.common.ChildrenPlacementType.Horizontal, "Children placement", primitives.common.ChildrenPlacementType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.RadioBoxConfig("leavesPlacementType", primitives.common.ChildrenPlacementType.Horizontal, "Leaves placement defines layout shape for items having no children", primitives.common.ChildrenPlacementType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.RadioBoxConfig("minimalVisibility", primitives.common.Visibility.Dot, "Minimal nodes visibility", primitives.common.Visibility, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.RadioBoxConfig("selectionPathMode", primitives.common.SelectionPathMode.FullStack, "Selection Path Mode sets visibility of items between cursor item and root", primitives.common.SelectionPathMode, helpers.controls.ValueType.Integer, onUpdate)
	]),
			new helpers.controls.PanelConfig("Default Template Options", [
				new helpers.controls.RadioBoxConfig("hasButtons", primitives.common.Enabled.Auto, "Show user buttons", primitives.common.Enabled, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.RadioBoxConfig("hasSelectorCheckbox", primitives.common.Enabled.True, "Show selection check box", primitives.common.Enabled, helpers.controls.ValueType.Integer, onUpdate)
			]),
			new helpers.controls.PanelConfig("Minimized Item (Dot, Marker)", [
				new helpers.controls.CaptionConfig("Be sure that you set border line width and color for markers having no fill, othewise you are not going to see them.", false),
				new helpers.controls.DropDownBoxConfig("minimizedItemSize", 4, "Marker size", [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 14, 16, 18, 20, 30, 40], helpers.controls.ValueType.Size, onUpdate),
				new helpers.controls.DropDownBoxConfig("minimizedItemCornerRadius", null, "Corner Radius", [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 20], helpers.controls.ValueType.Number, onUpdate),
				new helpers.controls.DropDownBoxConfig("highlightPadding", 2, "Highlight border padding around marker", [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], helpers.controls.ValueType.Thickness, onUpdate),
				new helpers.controls.RadioBoxConfig("minimizedItemShapeType", primitives.common.ShapeType.None, "Marker Shape", primitives.common.ShapeType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.DropDownBoxConfig("minimizedItemLineWidth", 1, "Marker border line width", [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], helpers.controls.ValueType.Number, onUpdate),
				new helpers.controls.RadioBoxConfig("minimizedItemLineType", primitives.common.LineType.Solid, "Marker border line type", primitives.common.LineType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.DropDownBoxConfig("minimizedItemBorderColor", null, "Marker border line color", primitives.common.Colors, helpers.controls.ValueType.String, onUpdate),
				new helpers.controls.DropDownBoxConfig("minimizedItemFillColor", null, "Marker fill color", primitives.common.Colors, helpers.controls.ValueType.String, onUpdate),
				new helpers.controls.DropDownBoxConfig("minimizedItemOpacity", 1.0, "Opacity", [0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1.0], helpers.controls.ValueType.Number, onUpdate)
			], "DefaultTemplateOptions"),
			new helpers.controls.PanelConfig("Intervals", [
				new helpers.controls.CaptionConfig("Vertical Intervals Between Rows", true),
				new helpers.controls.DropDownBoxConfig("normalLevelShift", 20, "Normal", [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 14, 16, 18, 20, 30, 40], helpers.controls.ValueType.Number, onUpdate),
				new helpers.controls.DropDownBoxConfig("dotLevelShift", 20, "Dotted", [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 14, 16, 18, 20, 30, 40], helpers.controls.ValueType.Number, onUpdate),
				new helpers.controls.DropDownBoxConfig("lineLevelShift", 10, "Lined", [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 14, 16, 18, 20, 30, 40], helpers.controls.ValueType.Number, onUpdate),

				new helpers.controls.CaptionConfig("Horizontal Intervals Between Items in Row", true),
				new helpers.controls.DropDownBoxConfig("normalItemsInterval", 10, "Normal", [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 14, 16, 18, 20, 30, 40], helpers.controls.ValueType.Number, onUpdate),
				new helpers.controls.DropDownBoxConfig("dotItemsInterval", 2, "Dotted", [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 14, 16, 18, 20, 30, 40], helpers.controls.ValueType.Number, onUpdate),
				new helpers.controls.DropDownBoxConfig("lineItemsInterval", 2, "Lined", [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 14, 16, 18, 20, 30, 40], helpers.controls.ValueType.Number, onUpdate),

				new helpers.controls.DropDownBoxConfig("cousinsIntervalMultiplier", 5, "Additional interval multiplier between cousins, it creates extra space between hierarchies", [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 14, 16, 18, 20, 30, 40], helpers.controls.ValueType.Number, onUpdate)
			]),
			new helpers.controls.PanelConfig("Connectors", [
				new helpers.controls.RadioBoxConfig("arrowsDirection", primitives.common.GroupByType.None, "Arrows Direction", primitives.common.GroupByType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.RadioBoxConfig("connectorType", primitives.common.ConnectorType.Squared, "Connectors", primitives.common.ConnectorType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.RadioBoxConfig("elbowType", primitives.common.ElbowType.None, "Elbows Type", primitives.common.ElbowType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.RadioBoxConfig("linesType", primitives.common.LineType.Solid, "Line type", primitives.common.LineType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.DropDownBoxConfig("linesColor", primitives.common.Colors.Silver, "Color", primitives.common.Colors, helpers.controls.ValueType.String, onUpdate),
				new helpers.controls.DropDownBoxConfig("linesWidth", 1, "Line width", [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], helpers.controls.ValueType.Number, onUpdate)
			]),
			new helpers.controls.PanelConfig("Labels", [
				new helpers.controls.CaptionConfig("Label property should be defined for every item first, otherwise they are not visible. Labels are visible only for markers. If you need to add labels to normal size items you have to modify default item template and place text outside item boundaries.", false),
				new helpers.controls.RadioBoxConfig("showLabels", primitives.common.Enabled.Auto, "Show labels", primitives.common.Enabled, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.RadioBoxConfig("labelOrientation", primitives.text.TextOrientationType.Horizontal, "Label Orientation", primitives.text.TextOrientationType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.RadioBoxConfig("labelPlacement", primitives.common.PlacementType.Top, "Label Placement", primitives.common.PlacementType, helpers.controls.ValueType.Integer, onUpdate)
			]),
			new helpers.controls.PanelConfig("Callout", [
				new helpers.controls.CaptionConfig("By default callout displays item content, but it can be redefined with custom callout template.", false),
				new helpers.controls.DropDownBoxConfig("showCallout", "true", "This option controls callout visibility for minimized items and it can be ovewritten pre item", ["true", "false"], helpers.controls.ValueType.Boolean, onUpdate),
				new helpers.controls.DropDownBoxConfig("calloutPlacementOffset", 100, "Call out placement offset", [10, 20, 30, 40, 50, 100, 200, 300], helpers.controls.ValueType.Number, onUpdate),
				new helpers.controls.DropDownBoxConfig("calloutfillColor", "#000000", "Fill color", primitives.common.Colors, helpers.controls.ValueType.String, onUpdate),
				new helpers.controls.DropDownBoxConfig("calloutBorderColor", null, "Border line color", primitives.common.Colors, helpers.controls.ValueType.String, onUpdate),
				new helpers.controls.DropDownBoxConfig("calloutOffset", 4, "Offset", [0, 1, 2, 3, 4, 5, 10, 20, 30], helpers.controls.ValueType.Number, onUpdate),
				new helpers.controls.DropDownBoxConfig("calloutCornerRadius", 4, "Corner Radius", ["0%", "5%", "10%", "20%", 0, 1, 2, 3, 4, 5, 10, 20, 30], helpers.controls.ValueType.String, onUpdate),
				new helpers.controls.DropDownBoxConfig("calloutPointerWidth", "10%", "Pointer Base Width", ["0%", "5%", "10%", "20%", 0, 5, 10, 20, 50], helpers.controls.ValueType.String, onUpdate),
				new helpers.controls.DropDownBoxConfig("calloutLineWidth", 1, "Line width", [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], helpers.controls.ValueType.Number, onUpdate),
				new helpers.controls.DropDownBoxConfig("calloutOpacity", 0.2, "Opacity", [0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1.0], helpers.controls.ValueType.Number, onUpdate)
			]),
			new helpers.controls.PanelConfig("Interactivity", [
				new helpers.controls.CaptionConfig("Use this option to disable mouse highlight on touch devices.", false),
				new helpers.controls.RadioBoxConfig("navigationMode", primitives.common.NavigationMode.Default, "Navigation mode", primitives.common.NavigationMode, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.CaptionConfig("This option defines highlight gravity radius, so minimized item gets highlighted when mouse pointer does not overlap marker but it is within gravity radius of its boundaries.", false),
				new helpers.controls.DropDownBoxConfig("highlightGravityRadius", 40, "Normal", [0, 5, 10, 20, 30, 40, 50, 100, 200, 1000], helpers.controls.ValueType.Number, onUpdate)
			]),
			new helpers.controls.PanelConfig("Rendering", [
				new helpers.controls.CaptionConfig("By default widget preferes SVG graphics mode. Use this property to enforce graphics mode programmatically.", false),
				new helpers.controls.RadioBoxConfig("graphicsType", primitives.common.GraphicsType.SVG, "Graphics", primitives.common.GraphicsType, helpers.controls.ValueType.Integer, onUpdate),
				new helpers.controls.CaptionConfig("In order to achive better greacefull degradation of your diagram use item templates of various sizes instead of CSS scale.", false),
				new helpers.controls.DropDownBoxConfig("scale", 1.0, "CSS Scale", { "50%": 0.5, "60%": 0.6, "70%": 0.7, "80%": 0.8, "90%": 0.9, "100%": 1.0, "110%": 1.1, "120%": 1.2, "130%": 1.3, "140%": 1.4, "150%": 1.5, "160%": 1.6, "170%": 1.7, "180%": 1.8, "190%": 1.9, "200%": 2.0 }, helpers.controls.ValueType.Number, onUpdate)
			])
	];
};
